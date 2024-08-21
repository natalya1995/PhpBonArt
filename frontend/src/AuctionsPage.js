import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { ListGroup, Spinner } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import './AuctionsPage.css';

const AuctionsPage = () => {
  const [activeAuctions, setActiveAuctions] = useState([]);
  const [completedAuctions, setCompletedAuctions] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get('http://backend:8080/api/auctions')
      .then(response => {
        const now = new Date();
        const active = response.data.filter(auction => new Date(auction.end_time) > now);
        const completed = response.data.filter(auction => new Date(auction.end_time) <= now);
        setActiveAuctions(active);
        setCompletedAuctions(completed);
        setLoading(false);
      })
      .catch(error => {
        console.error('Error fetching auctions:', error);
        setLoading(false);
      });
  }, []);

  if (loading) {
    return (
      <div className="d-flex justify-content-center align-items-center" style={{ height: '100vh' }}>
        <Spinner animation="border" />
      </div>
    );
  }

  return (
    <div className="auctions-page">
      <h2>Действующие Аукционы</h2>
      {activeAuctions.length === 0 ? (
        <p>Нет действующих аукционов.</p>
      ) : (
        <ListGroup>
          {activeAuctions.map(auction => (
            <ListGroup.Item key={auction.id}>
              <Link to={`/auctions/${auction.id}`}>
                {auction.name} (Заканчивается: {new Date(auction.end_time).toLocaleString()})
              </Link>
            </ListGroup.Item>
          ))}
        </ListGroup>
      )}

      <h2 className="mt-4">Завершенные Аукционы</h2>
      {completedAuctions.length === 0 ? (
        <p>Нет завершенных аукционов.</p>
      ) : (
        <ListGroup>
          {completedAuctions.map(auction => (
            <ListGroup.Item key={auction.id}>
              {auction.name} (Завершился: {new Date(auction.end_time).toLocaleString()})
            </ListGroup.Item>
          ))}
        </ListGroup>
      )}
        <a href='/user-bids'><p>Мои ставки</p></a>
    </div>
  );
};

export default AuctionsPage;
