import React, { useContext } from 'react';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';
import Home from './Home';
import CreatorDetail from './CreatorDetail';
import About from './About';
import Pictures from './Pictures';
import Creators from './Creators';
import Register from './Register';
import Cart from './Cart';
import Checkout from './Checkout';
import Login from './Login';
import Book from './Book';
import './Book.css';
import UserBids from './UserBids';
import './UserBids.css';
import Jewerly from './Jewerly';
import './Jewerly.css';
import './About.css';
import './App.css';
import './Login.css';
import './Register.css';
import './CreatorDetail.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import Navbar from 'react-bootstrap/Navbar';
import PictureDetail from './PictureDetail';
import AuctionsPage from './AuctionsPage';
import AuctionDetailsPage from './AuctionDetailsPage'; 
import { AuthProvider, AuthContext } from './AuthContext';
import './AuctionDetailsPage.css';
const CustomNavbar = () => {
  const { user, logout } = useContext(AuthContext);

  return (
    <Navbar bg="light" expand="lg">
      <Container>
        <Navbar.Brand href="/">
          <img src='https://bonart.kz/wp-content/uploads/2019/01/madrid-kiev-almaty.png' alt="BonArt" />
        </Navbar.Brand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          <ul className="navbar-nav">
            <li className="nav-item">
              <Link className="nav-link" to="/">Главная</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/about">О нас</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/pictures">Картины</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/auctions">Аукционы</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/book">Книги</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/creators">Художники</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/cart">Корзина</Link>
            </li>
          </ul>
          {user ? (
            <div className="ml-auto">
              <span className="navbar-text mr-3">Добро пожаловать, {user.name}!</span>
              <button className="btn btn-outline-danger" onClick={logout}>Выйти</button>
            </div>
          ) : (
            <ul className="navbar-nav ml-auto">
              <li className="nav-item">
                <Link className="nav-link" to="/login">Войти</Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="/register">Зарегистрироваться</Link>
              </li>
            </ul>
          )}
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
};

const App = () => {
  return (
    <Router>
      <AuthProvider>
        <CustomNavbar />
        <div className="content">
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/about" element={<About />} />
            <Route path="/pictures" element={<Pictures />} />
            <Route path="/pictures/:id" element={<PictureDetail />} />
            <Route path="/creators" element={<Creators />} />
            <Route path="/register" element={<Register />} />
            <Route path="/login" element={<Login />} />
            <Route path="/book" element={<Book />} />
            <Route path="/creators/:id" element={<CreatorDetail />} />
            <Route path="/cart" element={<Cart />} />
            <Route path="/checkout" element={<Checkout />} />
            <Route path="/jewerly" element={<Jewerly/>} />
            <Route path="/auctions" element={<AuctionsPage />} /> 
            <Route path="/auctions/:id" element={<AuctionDetailsPage />} />
            <Route path="/user-bids" element={<UserBids />} />
          </Routes>
        </div>
        <div className="footer">
          <h5>&copy; 2024 Бон Арт. Все права защищены.</h5>
          <h5>Адрес: пр. Сейфулина 597/7 </h5>
          <h5>
    <a 
      href="https://wa.me/77764770878" 
      target="_blank" 
      rel="noopener noreferrer"
      style={{ color: 'inherit', textDecoration: 'none' }}
    >
      Свяжитесь с нами в WhatsApp: +7 (776) 477-08-78
    </a>
  </h5>
        </div>
      </AuthProvider>
    </Router>
  );
};

export default App;
