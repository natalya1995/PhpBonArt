import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useParams } from 'react-router-dom';
import './CreatorDetail.css'; // Убедитесь, что путь правильный

const CreatorDetail = () => {
  const { id } = useParams();
  const [creator, setCreator] = useState(null);
  const [paintings, setPaintings] = useState([]);

  useEffect(() => {
    axios.get(`http://backend:8080/api/creators/${id}`)
      .then(response => {
        setCreator(response.data.creator);
        setPaintings(response.data.paintings);
      })
      .catch(error => {
        console.error('Error fetching creator details:', error);
      });
  }, [id]);

  if (!creator) {
    return <div>Загрузка...</div>;
  }

  return (
    <div className="creator-detail">
      <h2>{creator.name}</h2>
      <p>{creator.biography}</p>
      <div className="paintings">
        {paintings.length > 0 ? paintings.map(painting => (
          <div key={painting.id} className="painting-item">
            <img src={painting.img} alt={painting.title} className="painting-image" />
            <h4 className="painting-title">{painting.title}</h4>
            <p className="painting-description">{painting.description}</p>
          </div>
        )) : <p>No paintings available.</p>}
      </div>
    </div>
  );
};

export default CreatorDetail;
