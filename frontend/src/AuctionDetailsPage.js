import React, { useState, useEffect, useContext } from 'react';
import axios from 'axios';
import { useParams, useNavigate, Link } from 'react-router-dom'; // Добавлен Link
import { Button, Modal, Spinner } from 'react-bootstrap';
import { AuthContext } from './AuthContext';
import './AuctionDetailsPage.css';

const AuctionDetailsPage = () => {
  const { id } = useParams(); 
  const { user } = useContext(AuthContext);
  const [auction, setAuction] = useState(null);
  const [selectedItem, setSelectedItem] = useState(null);
  const [bidAmount, setBidAmount] = useState('');
  const [loading, setLoading] = useState(true);
  const [showModal, setShowModal] = useState(false);
  const [showSuccessModal, setShowSuccessModal] = useState(false); 
  const navigate = useNavigate();

  useEffect(() => {
    axios.get(`http://backend:8080/api/auctions/${id}`)
      .then(response => {
        setAuction(response.data);
        setLoading(false);
      })
      .catch(error => {
        console.error('Error fetching auction:', error);
        setLoading(false);
      });
  }, [id]);

  const handleBidSubmit = () => {
    const token = localStorage.getItem('token');
    const now = new Date().toISOString();
  
    if (!token) {
      alert('Токен авторизации не найден. Пожалуйста, войдите в систему.');
      navigate('/login');
      return;
    }
  
    if (!user || !user.id) {
      alert('Ошибка: Пользователь не авторизован или ID пользователя не определен.');
      return;
    }
  
    if (!selectedItem) {
      alert('Ошибка: Лот не выбран.');
      return;
    }
  
    const bidData = {
      auction_id: auction.id,
      item_id: selectedItem.id,
      user_id: user.id,
      bin_amount: bidAmount,
      bid_time: now,
    };
  
    axios.post('http://backend:8080/api/bids', bidData, {
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
      },
    })
    .then(response => {
      setShowModal(false);
      setShowSuccessModal(true); 
      setBidAmount('');
    })
    .catch(error => {
      console.error('Error making bid:', error);
      if (error.response) {
        console.error('Error response data:', error.response.data);
      }
      alert('Ошибка при выполнении ставки.');
    });
  };

  const handleItemClick = (item) => {
    setSelectedItem(item);
    setShowModal(true);
  };

  const handleModalClose = () => {
    setShowModal(false);
    setSelectedItem(null);
  };

  const handleSuccessModalClose = () => {
    setShowSuccessModal(false);
  };

  if (loading) {
    return (
      <div className="d-flex justify-content-center align-items-center" style={{ height: '100vh' }}>
        <Spinner animation="border" />
      </div>
    );
  }

  return (
    <div className="auction-details-page">
      <h2>{auction.name}</h2>
      <p>{auction.description}</p>
      <h3>Лоты</h3>
      <div className="items-list">
        {auction.items.map(item => (
          <div key={item.id} className="item-card">
            {item.picture && (
              <img className="item-img" src={item.picture.img} alt={item.name} />
            )}
            <h4>{item.name}</h4>
            <p>{item.description}</p>
            <p>Текущая цена: ${item.current_price}</p>
            <Button variant="primary" onClick={() => handleItemClick(item)}>
              Сделать ставку
            </Button>
            {item.picture && (
              <Link to={`/pictures/${item.picture.id}`} className="btn btn-info mt-2">
                Подробнее
              </Link>
            )}
          </div>
        ))}
      </div>

      {selectedItem && (
        <Modal show={showModal} onHide={handleModalClose} centered>
          <Modal.Header closeButton>
            <Modal.Title>Сделать ставку на {selectedItem.name}</Modal.Title>
          </Modal.Header>
          <Modal.Body>
            <p>Текущая цена: ${selectedItem.current_price}</p>
            <input
              type="number"
              className="form-control mb-3"
              placeholder="Ваша ставка"
              value={bidAmount}
              onChange={(e) => setBidAmount(e.target.value)}
            />
          </Modal.Body>
          <Modal.Footer>
            <Button variant="secondary" onClick={handleModalClose}>
              Закрыть
            </Button>
            <Button variant="primary" onClick={handleBidSubmit} disabled={!bidAmount}>
              Сделать ставку
            </Button>
          </Modal.Footer>
        </Modal>
      )}

      <Modal show={showSuccessModal} onHide={handleSuccessModalClose} centered>
        <Modal.Header closeButton>
          <Modal.Title>Ставка успешно сделана!</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <p>Ваша ставка на лот "{selectedItem?.name}" была успешно размещена.</p>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="primary" onClick={handleSuccessModalClose}>
            ОК
          </Button>
        </Modal.Footer>
      </Modal>
    </div>
  );
};

export default AuctionDetailsPage;
