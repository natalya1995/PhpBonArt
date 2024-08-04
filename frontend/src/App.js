import React, { useContext } from 'react';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';
import Home from './Home';
import About from './About';
import Pictures from './Pictures';
import Genres from './Genres';
import Creators from './Creators';
import Register from './Register';
import Login from './Login';
import MainPage from './MainPage';
import Book from './Book';
import './Book.css';
import './App.css';
import './Login.css';
import './Register.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import Navbar from 'react-bootstrap/Navbar';
import PictureDetail from './PictureDetail';
import { AuthProvider, AuthContext } from './AuthContext';

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
              <Link className="nav-link" to="/genres">Жанры</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/book">Книги</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/creators">Художники</Link>
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
    <AuthProvider>
      <Router>
        <CustomNavbar />
        <div className="content">
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/about" element={<About />} />
            <Route path="/pictures" element={<Pictures />} />
            <Route path="/genres" element={<Genres />} />
            <Route path="/pictures/:id" element={<PictureDetail />} />
            <Route path="/creators" element={<Creators />} />
            <Route path="/register" element={<Register />} />
            <Route path="/login" element={<Login />} />
            <Route path="/main" element={<MainPage />} />
            <Route path="/book" element={<Book />} />
          </Routes>
        </div>
        <div className="footer">
          <p>&copy; 2024 Бон Арт. Все права защищены.</p>
        </div>
      </Router>
    </AuthProvider>
  );
};

export default App;
