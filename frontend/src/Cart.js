import React, { useState, useContext, useEffect } from 'react';
import axios from 'axios';
import { Link, useNavigate } from 'react-router-dom';
import { AuthContext } from './AuthContext';
import { Spinner } from 'react-bootstrap'; // Импортируем Spinner
import './Cart.css';

const Cart = () => {
  const { user } = useContext(AuthContext);
  const [cartItems, setCartItems] = useState([]);
  const [loading, setLoading] = useState(true); // Состояние загрузки
  const navigate = useNavigate();

  useEffect(() => {
    const token = localStorage.getItem('token');
    if (user && token) {
      axios.get('http://backend:8080/api/cart', {
        headers: {
          'Authorization': `Bearer ${token}`
        },
        withCredentials: true
      })
      .then(response => {
        setCartItems(response.data);
        setLoading(false); // Остановка загрузки после получения данных
      })
      .catch(error => {
        console.error('Error fetching cart items:', error);
        if (error.response && error.response.status === 401) {
          navigate('/login');
        }
        setLoading(false); // Остановка загрузки даже в случае ошибки
      });
    } else {
      navigate('/login');
    }
  }, [user, navigate]);

  const handleRemoveFromCart = (id) => {
    const token = localStorage.getItem('token');

    axios.delete(`http://backend:8080/api/cart/${id}`, {
      headers: {
        'Authorization': `Bearer ${token}`
      },
      withCredentials: true
    })
    .then(() => {
      setCartItems(cartItems.filter(item => item.id !== id));
    })
    .catch(error => {
      console.error('Error removing item from cart:', error);
    });
  };

  const totalSum = cartItems.reduce((sum, item) => sum + parseFloat(item.price), 0);

  return (
    <div className="cart-container">
      <h1 className="cart-title">Ваша корзина</h1>
      {loading ? ( 
           <div className="d-flex justify-content-center align-items-center" style={{ height: '100vh' }}>
           <div className="spinner-border" role="status">
             <span className="sr-only">Загрузка...</span>
           </div>
         </div>
      ) : cartItems.length === 0 ? (
        <p>Ваша корзина пуста.</p>
      ) : (
        <div>
          <ul className="cart-items">
            {cartItems.map(item => (
              <li key={item.id} className="cart-item">
                <img src={item.picture.img} alt={item.picture.title} className="cart-item-img" />
                <div className="cart-item-info">
                  <h4 className="cart-item-title">{item.picture.title}</h4>
                  <p className="cart-item-description">{item.picture.description}</p>
                  <p className="cart-item-estimate">${item.price}</p>
                  <button onClick={() => handleRemoveFromCart(item.id)} className="btn btn-danger">Удалить</button>
                </div>
              </li>
            ))}
          </ul>
          <div className="cart-summary">
            <h3>Итого: ${totalSum.toFixed(2)}</h3>
          </div>
          <Link to="/checkout" className="btn btn-primary">Перейти к оформлению заказа</Link>
        </div>
      )}
    </div>
  );
};

export default Cart;
