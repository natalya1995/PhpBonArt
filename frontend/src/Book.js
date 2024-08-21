import React, { useEffect, useState, useContext } from 'react';
import axios from 'axios';
import { Link, useNavigate } from 'react-router-dom';
import { Modal, Button, Spinner } from 'react-bootstrap'; 
import './Book.css';
import { AuthContext } from './AuthContext';

const Book = () => {
  const [books, setBooks] = useState([]);
  const [cartItems, setCartItems] = useState([]); 
  const { user } = useContext(AuthContext);
  const navigate = useNavigate();
  const [showModal, setShowModal] = useState(false);
  const [modalMessage, setModalMessage] = useState('');
  const [loadingCart, setLoadingCart] = useState(true); 
  const [loadingBook, setLoadingBook] = useState(true); 

  useEffect(() => {
    axios.get('http://backend:8080/api/books')
      .then(response => {
        setBooks(response.data);
        setLoadingBook(false);
      })
      .catch(error => {
        console.error('Error fetching books:', error);
        setLoadingBook(false);
      });

    const token = localStorage.getItem('token');
    if (token) {
      axios.get('http://backend:8080/api/cart', {
        headers: {
          'Authorization': `Bearer ${token}`,
        },
        withCredentials: true
      })
      .then(response => {
        setCartItems(response.data); 
        setLoadingCart(false); 
      })
      .catch(error => {
        console.error('Error fetching cart items:', error);
        setModalMessage('Ошибка при загрузке корзины. Пожалуйста, попробуйте снова.');
        setShowModal(true);
        setLoadingCart(false); 
      });
    } else {
      setLoadingCart(false); 
    }
  }, []);

  const handleAddToCart = (book) => {
    const token = localStorage.getItem('token');
  
    if (!token) {
      console.error('No token found');
      navigate('/login');
      return;
    }
    const isAlreadyInCart = cartItems.some(item => item.book && item.book.id === book.id);
    if (isAlreadyInCart) {
      setModalMessage(`${book.title} уже находится в корзине.`);
      setShowModal(true);
      return;
    }
    axios.post('http://backend:8080/api/cart/add', {
      book_id: book.id,
      price: parseFloat(book.estimate),
    }, {
      headers: {
          'Authorization': `Bearer ${token}`,
      },
      withCredentials: true
    })
    .then(response => {
      setCartItems([...cartItems, response.data]); 
      setModalMessage(`${book.title} добавлен в корзину!`);
      setShowModal(true);
    })
    .catch(error => {
      console.error('Error adding to cart:', error.response ? error.response.data : error.message);
      setModalMessage('Не удалось добавить в корзину. Попробуйте снова.');
      setShowModal(true);
    });
  };

  if (loadingBook || loadingCart) {
    return (
      <div className="d-flex justify-content-center align-items-center" style={{ height: '100vh' }}>
        <Spinner animation="border" />
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
            <button 
              className="btn btn-success auction-book-link"
              onClick={() => handleAddToCart(book)}
            >
              В корзину
            </button>
          </div>
        </div>
      ))}
       <Modal show={showModal} onHide={() => setShowModal(false)}>
        <Modal.Header closeButton>
          <Modal.Title>Уведомление</Modal.Title>
        </Modal.Header>
        <Modal.Body>{modalMessage}</Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={() => setShowModal(false)}>
            Закрыть
          </Button>
          <Button variant="primary" onClick={() => navigate('/cart')}>
            Перейти в корзину
          </Button>
        </Modal.Footer>
      </Modal>
    </div>
  );
};

export default Book;
