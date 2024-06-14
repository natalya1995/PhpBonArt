import React, { useEffect, useState } from 'react';

const ApiComponent = () => {
  const [pictures, setPictures] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch('http://localhost:8080/api/pictures', {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
          },
        });
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        const data = await response.json();
        setPictures(data); 
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    fetchData();
  }, []); 
  return (
    <div>
      <h1>API Data</h1>
      <ul>
        {pictures.map(picture => (
          <li key={picture.id}>
            <img src={picture.img} alt={picture.title} />
            <p>{picture.title}</p>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default ApiComponent;
