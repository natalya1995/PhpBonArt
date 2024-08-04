import React, { useEffect, useState } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import './Home.css';

const Home = () => {
  useEffect(() => {
   
  }, []);

  return (
    <div id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
      <div className="jumbotron text-center">
        <h1>BON ART</h1>
        <h3>MADRID KIEV ALMATY</h3>
    
      </div>

      <div id="about" className="container-fluid">
        <div className="row">
          <div className="col-sm-8">
            <h2>Bon Art это...</h2><br />
            <h4>BonArt ставит своей задачей привлечение внимания казахстанского общества к миру искусства (картин и антиквариата), создание благоприятных условий для коллекционирования и сохранения культурного наследия.</h4><br />
            <p>Аукционный дом «BonArt» ставит своей основной задачей привлечение внимания общества к миру искусства, создание благоприятных условий для коллекционирования и сохранения культурного наследия. Открытые торги предметами искусства дают возможность приобрести произведение высокого художественного уровня с уверенностью в его подлинности и аутентичности. Произведения искусства являются одним из надежнейших предметов для инвестирования. Ведь весь опыт прошлого показывает, что стоимость произведения искусства со временем только возрастает.</p>
            {/* <br /><button className="btn btn-default btn-lg">Get in Touch</button> */}
          </div>
          <div className="col-sm-4">
            <span className="glyphicon glyphicon-signal logo"></span>
          </div>
        </div>
      </div>

      <div className="container-fluid bg-grey">
        <div className="row">
          <div className="col-sm-4">
            <span className="glyphicon glyphicon-globe logo slideanim"></span>
          </div>
        </div>
      </div>

      <div id="services" className="container-fluid text-center">
        <h2>УСЛУГИ</h2>
        <h4>Что мы предлагаем</h4>
        <br />
        <div className="row slideanim">
          <div className="col-sm-4">
            <span className="glyphicon glyphicon-off logo-small"></span>
            <h4></h4>
            <p></p>
          </div>
          <div className="col-sm-4">
            <span className="glyphicon glyphicon-heart logo-small"></span>
            <h4></h4>
            <p></p>
          </div>
          <div className="col-sm-4">
            <span className="glyphicon glyphicon-lock logo-small"></span>
            <h4></h4>
            <p></p>
          </div>
        </div>
        <br /><br />
        <div className="row slideanim">
          <div className="col-sm-4">
            <span className="glyphicon glyphicon-leaf logo-small"></span>
            <h4></h4>
            <p></p>
          </div>
          <div className="col-sm-4">
            <span className="glyphicon glyphicon-certificate logo-small"></span>
            <h4></h4>
            <p></p>
          </div>
          <div className="col-sm-4">
            <span className="glyphicon glyphicon-wrench logo-small"></span>
            <h4 style={{ color: '#303030' }}></h4>
            <p></p>
          </div>
        </div>
      </div>


      <div id="pricing" className="container-fluid">
        <div className="text-center">
          <h2></h2>
          <h4></h4>
        </div>
        <div className="row slideanim">
          <div className="col-sm-4 col-xs-12">
            <div className="panel panel-default text-center">
              <div className="panel-heading">
                <h1></h1>
              </div>
            </div>
          </div>
          <div className="col-sm-4 col-xs-12">
            <div className="panel panel-default text-center">
              <div className="panel-heading">
                <h1></h1>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="contact" className="container-fluid bg-grey">
        <h2 className="text-center"></h2>
        <div className="row">
          <div className="col-sm-5">
            <p></p>
            <p><span className="glyphicon glyphicon-map-marker"></span> </p>
            <p><span className="glyphicon glyphicon-phone"></span> </p>
            <p><span className="glyphicon glyphicon-envelope"></span> </p>
          </div>
        </div>
      </div>

      <footer className="container-fluid text-center">
        <a href="#myPage" title="To Top">
          <span className="glyphicon glyphicon-chevron-up"></span>
        </a>
      </footer>
    </div>
  );
};

export default Home;
