import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import './Book.css';

const Book = () => {
  const [books, setBooks] = useState([]);

  useEffect(() => {
    axios.get('http://backend:8080/api/books')
      .then(response => {
        console.log('Response data:', response.data); // Отладка ответа
        setBooks(response.data);
      })
      .catch(error => {
        console.error('Error fetching books:', error);
      });
  }, []);

  if (books.length === 0) {
    return (
      <div className="d-flex justify-content-center align-items-center" style={{ height: '100vh' }}>
        <div className="spinner-border" role="status">
          <span className="sr-only">Загрузка...</span>
        </div>
      </div>
    );
  }
  return (
    <div className="auction-books">
      {books.map(book => (
        <div key={book.id} className="auction-book">
          <Link to={`/books/${book.id}`}>
            <img className="auction-book-img" src={book.img} alt={book.title} />
          </Link>
          <div className="auction-book-info">
            <h4 className="auction-book-title">{book.title}</h4>
            <p className="auction-book-description">{book.description}</p>
            <p className="auction-book-estimate">${book.estimate}</p>
            <a className="btn btn-success auction-book-link" href={book.link}>В корзину</a>
          </div>
        </div>
      ))}
    </div>
  );
};

export default Book;
