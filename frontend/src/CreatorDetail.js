import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useParams, Link } from 'react-router-dom';
import './CreatorDetail.css';

const CreatorDetail = () => {
  const { id } = useParams();
  const [creator, setCreator] = useState(null);
  const [paintings, setPaintings] = useState([]);
  const [error, setError] = useState(null);

  useEffect(() => {
    axios.get(`http://localhost:8080/api/creators/${id}`)
      .then(response => {
        console.log(response.data);
        setCreator(response.data.creator);
        setPaintings(response.data.creator.pictures);
        setError(null);
      })
      .catch(error => {
        console.error('Error fetching creator details:', error);
        setError('Failed to load creator details. Please try again later.');
      });
  }, [id]);

  if (error) {
    return <div>{error}</div>;
  }

  if (!creator) {
    return (
      <div className="d-flex justify-content-center align-items-center" style={{ height: '100vh' }}>
        <div className="spinner-border" role="status">
          <span className="sr-only">Загрузка...</span>
        </div>
      </div>
    );
  }

  return (
    <div className="creator-detail">
      <h2>{creator.name}</h2>
      <p>{creator.biography}</p>
      <div className="paintings">
        {paintings.length > 0 ? paintings.map(painting => (
          <div key={painting.id} className="painting-item">
            <Link to={`/pictures/${painting.id}`}>
              <img src={painting.img} alt={painting.title} className="painting-image" />
            </Link>
            <h4 className="painting-title">{painting.title}</h4>
            <p className="painting-description">{painting.description}</p>
          </div>
        )) : <p>В базе нет картин.</p>}
      </div>
    </div>
  );
};

export default CreatorDetail;
