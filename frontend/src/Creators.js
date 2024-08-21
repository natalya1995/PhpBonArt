import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import './Creators.css'; 
const Creators = () => {
  const [creators, setCreators] = useState([]);

  useEffect(() => {
    axios.get('http://backend:8080/api/creators')
      .then(response => {
        console.log('Response data:', response.data);
        setCreators(response.data); 
      })
      .catch(error => {
        console.error('Error fetching creators:', error);
      });
  }, []);
  if (creators.length === 0) {
    return (
      <div className="d-flex justify-content-center align-items-center" style={{ height: '100vh' }}>
        <div className="spinner-border" role="status">
          <span className="sr-only"></span>
        </div>
      </div>
    );
  }

  return (
    <div className="auction-creators">
      {creators.map(creator => (
        <div key={creator.id} className="creator-item">
          <Link to={`/creators/${creator.id}`} className="creator-link">
            <h4 className="creator-title">{creator.name}</h4>
            <p className="creator-info">{creator.bio}</p>
          </Link>
        </div>
      ))}
    </div>
  );
};

export default Creators;
