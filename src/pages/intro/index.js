import React, { useState } from 'react'; 
import { Container, Row, Col } from 'react-grid';
import { Helmet } from 'react-helmet'; 

import { IMAGES } from '../../data/static'; 

// import logo from '../../assets/images/logo.svg';
import Logo from '../../shared/logo'; 
import './styles.css';

function App() {

  const index = Math.round(Math.random() * (IMAGES.length - 1));
  const [background] = useState(IMAGES[index]); 

  return (
    <>
      <Helmet>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
      </Helmet>
      <div className="sa-app" style={{backgroundImage: `url("${background}")`}}>
        <nav className="sa-nav sa-surface-2">
          <Container>
            <Row>
              <Col>
                <a href="./" className="sa-link">home</a>
                <a href="./" className="sa-link">projects</a>
                <a href="./" className="sa-link">resume</a>
              </Col>
            </Row>
          </Container>
        </nav>
        <header className="sa-main sa-banner sa-project">
          <Container>
            <Row>
              <Col md="6" offset={{md:3}}>
                {/* <img src={logo} alt="Samuel Acuna logo" /> */}
                <Logo />
              </Col>
            </Row>
            <br />
            <Row>
              <Col md="6" offset={{md:3}}>
                <p>
                  hello. i am a design engineer working on applications, libraries, tools, and experiences for optimal product development.
                </p>
              </Col>
            </Row>
            <br />
            <Row>
              <Col md="6" offset={{md:3}}>
                <div className="sa-button-group">
                  <a href="./samuelacuna-resume.pdf" target="_blank" rel="noreferrer" className="sa-button sa-button-small">
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    resume
                  </a>
                  <a href="https://www.linkedin.com/in/samuelacuna" target="_blank" rel="noreferrer" className="sa-button sa-button-small">
                    <i class="fa fa-linkedin"></i>&nbsp;
                    linkedin
                  </a>
                  <a href="http://github.com/samueleishion" target="_blank" rel="noreferrer" className="sa-button sa-button-small">
                    <i class="fa fa-github-alt"></i>&nbsp;
                    github
                  </a>
                </div>
              </Col>
            </Row>
          </Container>
        </header>
        <main>
          <div className="sa-divider sa-surface-1">
            <h2 className="sa-divider-label">
              projects
            </h2>
          </div>
          <section className="sa-banner sa-project">
          <Container>
            <Row>
              <Col md="6" offset={{md:3}}>
                project 1
              </Col>
            </Row>
          </Container>
          </section>
        </main>
        <footer className="sa-footer sa-surface-2">
          <Container>
            <Row>
              <Col>
                2022 &copy; samuel.acuna
              </Col>
            </Row>
          </Container>
        </footer>
      </div>
    </>
  );
}

export default App;
