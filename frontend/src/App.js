import React from 'react';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';
import Home from './Home';
import About from './About';
import Pictures from './Pictures';
import Genres from './Genres';
import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import Navbar from 'react-bootstrap/Navbar';
import PictureDetail from './PictureDetail';
const App = () => {
  return (
    <Router><Navbar>

       <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="">BonArt</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
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
            </ul>
    </div>
  </div>
</nav>

</Navbar>
        <div className="content">
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/about" element={<About />} />
            <Route path="/pictures" element={<Pictures />} />
            <Route path="/genres" element={<Genres />} />
            <Route path="/pictures/:id" element={<PictureDetail />} />
          </Routes>
        </div>

        <div className="footer">
          <p>&copy; 2024 Бон Арт. Все права защищены.</p>
        </div>

    </Router>
  );
};

export default App;
