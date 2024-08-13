import React, { useEffect, useState, useContext } from 'react';
import axios from 'axios';
import { Link, useNavigate } from 'react-router-dom';
import { Modal, Button, Spinner } from 'react-bootstrap'; 
import './Pictures.css';
import { AuthContext } from './AuthContext';

const Pictures = () => {
  const [pictures, setPictures] = useState([]);
  const [cartItems, setCartItems] = useState([]); 
  const { user } = useContext(AuthContext);
  const navigate = useNavigate();
  const [showModal, setShowModal] = useState(false);
  const [modalMessage, setModalMessage] = useState('');
  const [loadingPictures, setLoadingPictures] = useState(true); 
  const [loadingCart, setLoadingCart] = useState(true); 

  useEffect(() => {
    axios.get('http://backend:8080/api/pictures')
      .then(response => {
        setPictures(response.data);
        setLoadingPictures(false); 
      })
      .catch(error => {
        console.error('Error fetching pictures:', error);
        setModalMessage('Ошибка при загрузке картин. Пожалуйста, попробуйте снова.');
        setShowModal(true);
        setLoadingPictures(false); // Ошибка загрузки, остановка спиннера
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
        setLoadingCart(false); // Загрузка завершена
      })
      .catch(error => {
        console.error('Error fetching cart items:', error);
        setModalMessage('Ошибка при загрузке корзины. Пожалуйста, попробуйте снова.');
        setShowModal(true);
        setLoadingCart(false); // Ошибка загрузки, остановка спиннера
      });
    } else {
      setLoadingCart(false); // Нет токена, остановка спиннера
    }
  }, []);

  const handleAddToCart = (picture) => {
    const token = localStorage.getItem('token');
  
    if (!token) {
      console.error('No token found');
      navigate('/login');
      return;
    }
  
    const isAlreadyInCart = cartItems.some(item => item.picture.id === picture.id);
  
    if (isAlreadyInCart) {
      setModalMessage(`${picture.title} уже находится в корзине.`);
      setShowModal(true);
      return;
    }
  
    axios.post('http://backend:8080/api/cart/add', {
        picture_id: picture.id,
        price: parseFloat(picture.estimate),
        bids_id: picture.bids_id || null,
        purchase_type: picture.purchase_type || null,
    }, {
        headers: {
            'Authorization': `Bearer ${token}`,
        },
        withCredentials: true
    })
    .then(response => {
        setCartItems([...cartItems, response.data]); 
        setModalMessage(`${picture.title} добавлен в корзину!`);
        setShowModal(true);
    })
    .catch(error => {
        console.error('Error adding to cart:', error);
        setModalMessage('Не удалось добавить в корзину. Попробуйте снова.');
        setShowModal(true);
    });
  };

  if (loadingPictures || loadingCart) {
    return (
      <div className="d-flex justify-content-center align-items-center" style={{ height: '100vh' }}>
        <div className="spinner-border" role="status">
          <span className="sr-only">Загрузка...</span>
        </div>
      </div>
    );
  }

  return (
    <div className="auction-pictures">
      {pictures.map(picture => (
        <div key={picture.id} className="auction-picture">
          <Link to={`/pictures/${picture.id}`}>
            <img className="auction-picture-img" src={picture.img} alt={picture.title} />
          </Link>
          <div className="auction-picture-info">
            <h4 className="auction-picture-title">{picture.title}</h4>
            <p className="auction-picture-description">{picture.description}</p>
            <p className="auction-picture-estimate">${picture.estimate}</p>
            <button 
              className="btn btn-success auction-picture-link"
              onClick={() => handleAddToCart(picture)}
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

export default Pictures;
