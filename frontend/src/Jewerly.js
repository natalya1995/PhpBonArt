import React, { useState, useEffect, useContext } from 'react';
import axios from 'axios';
import { Link, useNavigate } from 'react-router-dom';
import { Modal, Button, Spinner } from 'react-bootstrap'; 
import './Jewerly.css';
import { AuthContext } from './AuthContext';

const Jewerly = () => {
  const [jewerlies, setJewerlies] = useState([]);
  const [cartItems, setCartItems] = useState([]); 
  const { user } = useContext(AuthContext);
  const navigate = useNavigate();
  const [showModal, setShowModal] = useState(false);
  const [modalMessage, setModalMessage] = useState('');
  const [loadingJewerlies, setLoadingJewerlies] = useState(true); 
  const [loadingCart, setLoadingCart] = useState(true); 

  useEffect(() => {
    axios.get('http://backend:8080/api/jewerlies')
      .then(response => {
        setJewerlies(response.data);
        setLoadingJewerlies(false); 
      })
      .catch(error => {
        console.error('Error fetching jewerlies:', error);
        setModalMessage('Ошибка при загрузке ювелирных изделий. Пожалуйста, попробуйте снова.');
        setShowModal(true);
        setLoadingJewerlies(false); 
      });

    const token = localStorage.getItem('token');
    if (token) {
      axios.get('http://backend:8080/api/cart', {
        headers: {
          'Authorization': `Bearer ${token}`,
        },
        withCredentials: true
      })
      .then(response => {
        setCartItems(response.data); 
        setLoadingCart(false); 
      })
      .catch(error => {
        console.error('Error fetching cart items:', error);
        setModalMessage('Ошибка при загрузке корзины. Пожалуйста, попробуйте снова.');
        setShowModal(true);
        setLoadingCart(false); 
      });
    } else {
      setLoadingCart(false); 
    }
  }, []);

  const handleAddToCart = (jewerly) => {
    const token = localStorage.getItem('token');

    if (!token) {
      console.error('No token found');
      navigate('/login');
      return;
    }

    if (!jewerly || !jewerly.id) {
      console.error('Jewerly item or its ID is undefined');
      setModalMessage('Произошла ошибка при добавлении в корзину. Попробуйте снова.');
      setShowModal(true);
      return;
    }

    const isAlreadyInCart = cartItems.some(item => item.jewerly && item.jewerly.id === jewerly.id);

    if (isAlreadyInCart) {
      setModalMessage(`${jewerly.title} уже находится в корзине.`);
      setShowModal(true);
      return;
    }

    axios.post('http://backend:8080/api/cart/add', {
        jewerly_id: jewerly.id,
        price: parseFloat(jewerly.estimate),
        bids_id: jewerly.bids_id || null,
        purchase_type: jewerly.purchase_type || null,
    }, {
        headers: {
            'Authorization': `Bearer ${token}`,
        },
        withCredentials: true
    })
    .then(response => {
        setCartItems([...cartItems, response.data]); 
        setModalMessage(`${jewerly.title} добавлено в корзину!`);
        setShowModal(true);
    })
    .catch(error => {
        console.error('Error adding to cart:', error);
        setModalMessage('Не удалось добавить в корзину. Попробуйте снова.');
        setShowModal(true);
    });
  };

  if (loadingJewerlies || loadingCart) {
    return (
      <div className="d-flex justify-content-center align-items-center" style={{ height: '100vh' }}>
        <Spinner animation="border" />
      </div>
    );
  }

  return (
    <div className="auction-jewerlies">
      {jewerlies.map(jewerly => (
        <div key={jewerly.id} className="auction-jewerly">
          <Link to={`/jewerlies/${jewerly.id}`}>
            <img className="auction-jewerly-img" src={jewerly.img} alt={jewerly.title} />
          </Link>
          <div className="auction-jewerly-info">
            <h4 className="auction-jewerly-title">{jewerly.title}</h4>
            <p className="auction-jewerly-description">{jewerly.description}</p>
            <p className="auction-jewerly-estimate">${jewerly.estimate}</p>
            <button 
              className="btn btn-success auction-jewerly-link"
              onClick={() => handleAddToCart(jewerly)}
            >
              В корзину
            </button>
          </div>
        </div>
      ))}

      <Modal show={showModal} onHide={() => setShowModal(false)}>
        <Modal.Header closeButton>
          <Modal.Title>Уведомление</Modal.Title>
        </Modal.Header>
        <Modal.Body>{modalMessage}</Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={() => setShowModal(false)}>
            Закрыть
          </Button>
          <Button variant="primary" onClick={() => navigate('/cart')}>
            Перейти в корзину
          </Button>
        </Modal.Footer>
      </Modal>
    </div>
  );
};

export default Jewerly;
