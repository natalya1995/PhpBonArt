import React, { useState } from 'react';
import axios from 'axios';
import { Modal, Button } from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import './Home.css';

const Home = () => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    message: ''
  });
  const [showModal, setShowModal] = useState(false); 
  const [modalMessage, setModalMessage] = useState(''); 
  const [isLoading, setIsLoading] = useState(false); 
  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    setIsLoading(true);
    axios.post('http://backend:8080/api/send-email', formData)
    .then(response => {
      console.log('Email sent successfully, server response:', response.data);
      setFormData({ name: '', email: '', message: '' }); // Очистить форму
      setModalMessage('Ваше сообщение было успешно отправлено!'); // Сообщение о успешной отправке
      setShowModal(true); // Показать модальное окно
    })
    .catch(error => {
      console.error('Не удалось отправить сообщение:', error);
      setModalMessage('Произошла ошибка при отправке сообщения. Пожалуйста, попробуйте снова.');
      setShowModal(true); // Показать модальное окно с ошибкой
    })
    .finally(() => {
      setIsLoading(false); // Завершить загрузку
    });
  };

  const handleCloseModal = () => {
    setShowModal(false);
  };

  return (
    <div id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
      <div className="jumbotron text-center">
        <h1>BON ART</h1>
        <h1>MADRID KIEV ALMATY</h1>
      </div>

      <div id="about" className="container-fluid">
        <div className="row">
          <div className="col-sm-8">
            <h2>Bon Art это...</h2><br />
            <h4>BonArt ставит своей задачей привлечение внимания казахстанского общества к миру искусства (картин и антиквариата), создание благоприятных условий для коллекционирования и сохранения культурного наследия.</h4><br />
            <p>Аукционный дом «BonArt» ставит своей основной задачей привлечение внимания общества к миру искусства, создание благоприятных условий для коллекционирования и сохранения культурного наследия. Открытые торги предметами искусства дают возможность приобрести произведение высокого художественного уровня с уверенностью в его подлинности и аутентичности. Произведения искусства являются одним из надежнейших предметов для инвестирования. Ведь весь опыт прошлого показывает, что стоимость произведения искусства со временем только возрастает.</p>
          </div>
          <div className="col-sm-4">
            <span className="glyphicon glyphicon-signal logo"></span><img className='IMG' src="https://r3.mt.ru/r7/photo5042/20931211476-0/jpg/bp.jpeg" alt="Bon Art"></img>
          </div>
        </div>
      </div>

      <div id="services" className="container-fluid text-center">
        <h1><b>УСЛУГИ</b></h1>
        <br />
        <div className="row slideanim">
          <div className="col-sm-4">
            <h4><a href="/pictures">Купить живопись и книги</a></h4>
            <p>У нас Вы можете купить картины в Алматы и Астане известных художников Казахстана и европейских художников; купить антиквариат и старинную живопись прошедшую проверку на подлинность и экспертизу.</p>
            <img src="https://i.pinimg.com/736x/80/88/f9/8088f983d10de2dabfd8ca6566cbe142.jpg" alt="Живопись и книги"></img>
          </div>
          <div className="col-sm-4">
            <h4><a href="jewerly/" >Купить антикварные ювелирные украшения</a></h4>
            <p>Ювелирные украшения – это не просто изделия, это целое искусство и значительная часть национальной культуры казахского народа и ее истории, корни которой уходят глубоко в прошлое.</p>
            <img src="https://i.pinimg.com/736x/a4/e0/65/a4e06546141941483ee4c9af192a66f0.jpg" alt="Антикварные ювелирные украшения"></img>
          </div>
          <div className="col-sm-4">
            <h4><a href="/">Онлайн аукцион</a></h4>
            <p>Онлайн-аукцион предметов искусства – это современная и увлекательная платформа, где коллекционеры, инвесторы и любители искусства могут приобрести уникальные произведения, не выходя из дома.</p>
            <img src="https://i.pinimg.com/736x/5e/66/3c/5e663c5539f84d8e089513dfb4d841d8.jpg" alt="Онлайн аукцион"></img>
          </div>
        </div>
      </div>

      <div id="pricing" className="container-fluid">
        <div className="text-center">
          <h2>Хотите продать картину из своей коллекции?</h2>
          <h4>Свяжитесь с нами!</h4>
          {isLoading ? (
         <div className="d-flex justify-content-center align-items-center" style={{ height: '100vh' }}>
         <div className="spinner-border" role="status">
           <span className="sr-only">Загрузка...</span>
         </div>
       </div>
        ) : (
      
          <form onSubmit={handleSubmit}>
            <div className="form-group">
              <label>Ваше имя:</label>
              <input
                type="text"
                className="form-control"
                name="name"
                value={formData.name}
                onChange={handleChange}
                required
              />
            </div>
            <div className="form-group">
              <label>Email:</label>
              <input
                type="email"
                className="form-control"
                name="email"
                value={formData.email}
                onChange={handleChange}
                required
              />
            </div>
            <div className="form-group">
              <label>Сообщение:</label>
              <textarea
                className="form-control"
                name="message"
                value={formData.message}
                onChange={handleChange}
                rows="5"
                required
              ></textarea>
            </div>
            <button type="submit" className="btn btn-primary">Отправить</button>
          </form>
        )}
        </div>
      </div>
        );
      <Modal show={showModal} onHide={handleCloseModal}>
        <Modal.Header closeButton>
          <Modal.Title>Уведомление</Modal.Title>
        </Modal.Header>
        <Modal.Body>{modalMessage}</Modal.Body>
        <Modal.Footer>
          <Button variant="primary" onClick={handleCloseModal}>
            Закрыть
          </Button>
        </Modal.Footer>
      </Modal>

      <footer className="container-fluid text-center">
        <a href="#myPage" title="To Top">
          <span className="glyphicon glyphicon-chevron-up"></span>
        </a>
      </footer>
    </div>
  );
};

export default Home;
