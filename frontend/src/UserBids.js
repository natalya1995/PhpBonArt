import React, { useEffect, useState, useContext } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import { AuthContext } from './AuthContext';
import { Modal, Button, Spinner } from 'react-bootstrap';
import './UserBids.css';

const UserBids = () => {
  const { user } = useContext(AuthContext);
  const [bids, setBids] = useState([]);
  const [loading, setLoading] = useState(true);
  const navigate = useNavigate();
  const [cartItems, setCartItems] = useState([]);
  const [modalMessage, setModalMessage] = useState('');
  const [showModal, setShowModal] = useState(false);
  const [modalButtonVisible, setModalButtonVisible] = useState(false);

  useEffect(() => {
    const token = localStorage.getItem('token');

    if (!token) {
      navigate('/login');
      return;
    }

    axios.get('http://backend:8080/api/user-bids', {
      headers: {
        'Authorization': `Bearer ${token}`,
      },
    })
    .then(response => {
      setBids(response.data);
      setLoading(false);
    })
    .catch(error => {
      console.error('Error fetching bids:', error);
      setLoading(false);
    });

    axios.get('http://backend:8080/api/cart', {
      headers: {
        'Authorization': `Bearer ${token}`,
      },
      withCredentials: true
    })
    .then(response => {
      setCartItems(response.data);
    })
    .catch(error => {
      console.error('Error fetching cart items:', error);
    });
  }, [navigate]);

  const handleAddToCart = (item) => {
    const token = localStorage.getItem('token');

    axios.post('http://backend:8080/api/cart/add', {
      picture_id: item.picture_id,
      price: parseFloat(item.current_price),
      purchase_type: item.purchase_type || null,
      bids_id: item.id || null,
    }, {
      headers: {
        'Authorization': `Bearer ${token}`,
      },
      withCredentials: true
    })
    .then(response => {
      setCartItems([...cartItems, response.data]);
      setModalMessage(`${item.name} добавлен в корзину!`);
      setShowModal(true);
      setModalButtonVisible(true);
      setBids(prevBids => prevBids.filter(bid => bid.item.id !== item.id));
    })
    .catch(error => {
      console.error('Error adding item to cart:', error);
      alert('Ошибка при добавлении в корзину');
    });
  };

  const handleCompleteAuction = (auctionId, bid) => {
    const token = localStorage.getItem('token');

    axios.post(`http://backend:8080/api/auctions/${auctionId}/complete`, {}, {
      headers: {
        'Authorization': `Bearer ${token}`,
      }
    })
    .then(() => {
     
      axios.get(`http://backend:8080/api/user-bids`, {
        headers: {
          'Authorization': `Bearer ${token}`,
        },
      })
      .then(response => {
        const updatedBid = response.data.find(updatedBid => updatedBid.id === bid.id);
        const isWinningBid = updatedBid.item.winning_bid_id === updatedBid.id;

        if (isWinningBid) {
          setModalMessage('Аукцион завершен. Ваша ставка победила!');
          setModalButtonVisible(true);  
          handleAddToCart(updatedBid.item);
        } else {
          setModalMessage('К сожалению, вашу ставку перебили.');
          setModalButtonVisible(false); 
        }
        setShowModal(true);
      })
      .catch(error => {
        console.error('Error fetching updated bid:', error);
        alert('Ошибка при обновлении данных о ставке');
      });
    })
    .catch(error => {
      console.error('Error completing auction:', error);
      alert('Ошибка при завершении аукциона');
    });
  };

  if (loading) {
    return (
      <div className="d-flex justify-content-center align-items-center" style={{ height: '100vh' }}>
        <Spinner animation="border" />
      </div>
    );
  }

  return (
    <div className="user-bids-page">
      <h2>Мои ставки</h2>
      {bids.length === 0 ? (
        <p>У вас нет активных ставок.</p>
      ) : (
        bids.filter(bid => !cartItems.some(cartItem => cartItem.picture_id === bid.item.picture_id)).map(bid => { 
          const isAuctionEnded = new Date(bid.auction.end_time) < new Date();

          return (
            <div key={bid.id} className="bid-card">
              <h4>{bid.item.name}</h4>
              <p>Ставка: ${bid.bin_amount}</p>
              {isAuctionEnded ? (
                <Button 
                  variant="warning" 
                  onClick={() => handleCompleteAuction(bid.auction.id, bid)}
                >
                  Результаты аукциона
                </Button>
              ) : (
                <p>Статус: Активный аукцион</p>
              )}
            </div>
          );
        })
      )}
      <Modal show={showModal} onHide={() => setShowModal(false)} centered>
        <Modal.Header closeButton>
          <Modal.Title>Уведомление</Modal.Title>
        </Modal.Header>
        <Modal.Body>{modalMessage}</Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={() => setShowModal(false)}>
            Закрыть
          </Button>
          {modalButtonVisible && (
            <Button variant="primary" onClick={() => navigate('/cart')}>
              Перейти в корзину
            </Button>
          )}
        </Modal.Footer>
      </Modal>
    </div>
  );
};

export default UserBids;
