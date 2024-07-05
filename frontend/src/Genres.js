// Genres.js
import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

const Genres = () => {
  const [genres, setGenres] = useState([]);

  useEffect(() => {
    axios.get('/api/janres')
      .then(response => setGenres(response.data))
      .catch(error => console.error('Error fetching genres:', error));
  }, []);

  return (
    <div className="container">
      <h2>Genres</h2>
      <ul>
        {genres.map(genre => (
          <li key={genre.id}>
            <Link to={`/pictures/${genre.id}`}>{genre.name}</Link>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default Genres;
