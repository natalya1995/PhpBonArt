import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
// import './Creators.css';

const Creators = () => {
  const [creators, setCreators] = useState([]);

  useEffect(() => {
    axios.get('http://backend:8080/api/creators')
      .then(response => {
        setCreators(response.data);
      })
      .catch(error => {
        console.error('Error fetching creators:', error);
      });
  }, []);
  if (!creators) {
    return <div>Loading...</div>;
  }
  return (
    <div className="auction-creators">
      {creators.map(creator => (
        <div key={creators.id} className="auction-creators">
          <Link to={`/creators/${creator.id}`}>
          <h4 className="auction-creators-title">{creator.name} {creator.YY} </h4>
          </Link>
        </div>
      ))}
    </div>
  );
};

export default Creators;
