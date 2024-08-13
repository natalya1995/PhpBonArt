import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Modal, Button, Spinner } from 'react-bootstrap';
import './Checkout.css';

const Checkout = () => {
  const [cartItems, setCartItems] = useState([]);
  const [orderDetails, setOrderDetails] = useState({
    address: '',
    paymentMethod: 'credit_card',
  });
  const [showModal, setShowModal] = useState(false);
  const [modalMessage, setModalMessage] = useState('');
  const [loading, setLoading] = useState(false); 

  useEffect(() => {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    setCartItems(cart);
  }, []);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setOrderDetails(prevDetails => ({
      ...prevDetails,
      [name]: value,
    }));
  };

  const handleOrderSubmit = () => {
    const token = localStorage.getItem('token');
    const order = {
        items: cartItems.map(item => ({
            picture_id: item.id,
            price: item.price,
        })),
        address: orderDetails.address,
        paymentMethod: orderDetails.paymentMethod,
        status_order: false, 
    };

    axios.post('http://backend:8080/api/orders', order, {
        headers: {
            'Authorization': `Bearer ${token}`, 
        },
    })
    .then(response => {
        setModalMessage('Заказ успешно оформлен! Вы можете перейти к оплате.');
        setShowModal(true);
        localStorage.removeItem('cart');
    })
    .catch(error => {
        console.error('Error placing order:', error.response.data);
        setModalMessage('Ошибка оформления заказа. Попробуйте снова.');
        setShowModal(true);
    });
};

  const handlePayment = () => {
    const token = localStorage.getItem('token');
    setLoading(true); 

    axios.put('http://backend:8080/api/orders/pay', null, {
      headers: {
        'Authorization': `Bearer ${token}`,
      },
    })
    .then(response => {
      setLoading(false); 
      setModalMessage('Заказ успешно оплачен! Спасибо за покупку!');
      setShowModal(true);
    })
    .catch(error => {
      setLoading(false); 
      console.error('Error paying for order:', error);
      setModalMessage('Ошибка платежа. Попробуйте снова.');
      setShowModal(true);
    });
  };

  const handleCloseModal = () => setShowModal(false);

  return (
    <div className="checkout">
      <h2>Оформить покупку</h2>
      <div className="checkout-details">
        <h5>Адрес доставки</h5>
        <input type="text" name="address" value={orderDetails.address} onChange={handleChange} placeholder="Введите свой адрес" />

        <h5>Способ оплаты</h5>
        <select name="paymentMethod" value={orderDetails.paymentMethod} onChange={handleChange}>
          <option value="credit_card">Карта</option>
          <option value="paypal">PayPal</option>
        </select>
      </div>
    
      <button 
        onClick={handlePayment} 
        className="btn btn-primary" 
        disabled={loading} 
      >
        {loading ? <Spinner animation="border" size="sm" /> : 'Оплатить заказ'}
      </button>

      <Modal show={showModal} onHide={handleCloseModal} centered>
        <Modal.Header closeButton>
          <Modal.Title>Уведомление</Modal.Title>
        </Modal.Header>
        <Modal.Body>{modalMessage}</Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={handleCloseModal}>Закрыть</Button>
        </Modal.Footer>
      </Modal>
    </div>
  );
};

export default Checkout;
