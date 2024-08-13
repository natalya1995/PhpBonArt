import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import './Jewerly.css';

const Jewerly = () => {
  const [jewerlies, setJewerlies] = useState([]);

  useEffect(() => {
    axios.get('http://backend:8080/api/jewerlies')
      .then(response => {
        console.log('Response data:', response.data); 
        setJewerlies(response.data);
      })
      .catch(error => {
        console.error('Error fetching jewerlies:', error);
      });
  }, []);

  if (jewerlies.length === 0) {
    return (
      <div className="d-flex justify-content-center align-items-center" style={{ height: '100vh' }}>
        <div className="spinner-border" role="status">
          <span className="sr-only">Загрузка...</span>
        </div>
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
            <a className="btn btn-success auction-jewerly-link" href={jewerly.link}>В корзину</a>
          </div>
        </div>
      ))}
    </div>
  );
};

export default Jewerly;
