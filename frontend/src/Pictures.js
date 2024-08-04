import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import './Pictures.css';

const Pictures = () => {
  const [pictures, setPictures] = useState([]);

  useEffect(() => {
    axios.get('http://backend:8080/api/pictures')
      .then(response => {
        setPictures(response.data);
      })
      .catch(error => {
        console.error('Error fetching pictures:', error);
      });
  }, []);
  if (pictures.length === 0) {
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
            <a className="btn btn-success auction-picture-link" href={picture.link}>Add to cart</a>
          </div>
        </div>
      ))}
    </div>
  );
};

export default Pictures;
