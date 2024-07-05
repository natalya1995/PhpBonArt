import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useParams } from 'react-router-dom';
import './PictureDetail.css';

const PictureDetail = () => {
  const { id } = useParams();
  const [picture, setPicture] = useState(null);

  useEffect(() => {
    axios.get(`http://backend:8080/api/pictures/${id}`)
      .then(response => {
        setPicture(response.data);
      })
      .catch(error => {
        console.error('Error fetching picture details:', error);
      });
  }, [id]);

  if (!picture) {
    return <div>Loading...</div>;
  }

  return (
    <div className="picture-detail">
      <img className="picture-detail-img" src={picture.img} alt={picture.title} />
      <div className="picture-detail-info">
        <h1 className="picture-detail-title">{picture.title}</h1>
        <p className="picture-detail-description">{picture.description}</p>
        <p className="picture-detail-estimate">Эстимейт ${picture.estimate}</p>
        <a className="btn btn-success picture-detail-link" href={picture.link}>В корзину</a>
      </div>
    </div>
  );
};

export default PictureDetail;
