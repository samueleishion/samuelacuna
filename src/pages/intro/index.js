import React, { useState } from 'react'; 
import { Container, Row, Col } from 'react-grid';
import { Helmet } from 'react-helmet'; 
import { scroller} from 'react-scroll';
import ReactGA from 'react-ga4';

import { IMAGES } from '../../data/static'; 
import projects from '../../data/projects'; 

import Logo from '../../shared/logo'; 
import Project from '../../shared/project';

import Resume from '../../assets/files/samuelacuna-resume.pdf'; 

import './styles.css';



function App() {
  React.useEffect(() => {
    if (process.env.REACT_APP_GOOGLE_ANALYTICS_ID) {
      ReactGA.initialize(process.env.REACT_APP_GOOGLE_ANALYTICS_ID);
    } else {
      // eslint-disable-next-line no-console
      console.warn('REACT_APP_GOOGLE_ANALYTICS_ID is not set. Google Analytics will not be initialized.');
    }
  }, []);
  const index = Math.round(Math.random() * (IMAGES.length - 1));
  const [background] = useState(IMAGES[index]); 

  const scrollTo = (e, id) => {
    e.preventDefault(); 
    scroller.scrollTo(id, {
      duration: 1000,
      delay: 0,
      smooth: 'easeInOutQuad'
    });
  }; 

  const scrollHome = (e) => {
    scrollTo(e, 'home'); 
  }; 

  const scrollProjects = (e) => {
    scrollTo(e, 'projects'); 
  }; 

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
                <a href="#home" className="sa-link sa-skip">skip to content</a>
                <a href="./" className="sa-link" onClick={scrollHome}>hello</a>
                <a href="./" className="sa-link" onClick={scrollProjects}>projects</a>
                <a href={Resume} target="_blank" rel="noopener noreferrer" className="sa-link">r&eacute;sum&eacute;</a>
              </Col>
            </Row>
          </Container>
        </nav>
        <header className="sa-header sa-banner sa-project" id="home">
          <Container className="sa-content">
            <Row>
              <Col md="6" sm="10" offset={{sm:1,md:3}}>
                <Logo />
              </Col>
            </Row>
          </Container>
          <div class="sa-project-description sa-content">
            <p>
              hello. i am a design engineer working on applications, libraries, tools, and experiences for optimal product development.
            </p>
          </div>
          <ul className="sa-button-group sa-content">
            <li>
              <a href={Resume} target="_blank" rel="noopener noreferrer" className="sa-button sa-button-small">
                <i className="fa fa-file-text-o"></i>&nbsp;
                r&eacute;sum&eacute;
              </a>
            </li>
            <li>
              <a href="http://github.com/samueleishion" target="_blank" rel="noopener noreferrer" className="sa-button sa-button-small">
                <i className="fa fa-github-alt"></i>&nbsp;
                github
              </a>
            </li>
            <li>
              <a href="https://www.linkedin.com/in/samuelacuna" target="_blank" rel="noopener noreferrer" className="sa-button sa-button-small">
                <i className="fa fa-linkedin"></i>&nbsp;
                linkedin
              </a>
            </li>
          </ul>
        </header>
        <main id="projects">
          <div className="sa-divider sa-surface-1">
            <h2 className="sa-divider-label">
              projects
            </h2>
          </div>
          {projects.map((p, i) => (
            <Project
              key={i}
              title={p.title}
              role={p.role}
              imageAsset={p.image.asset}
              imageAlt={p.image.alt}
              colorBackground={p.color.background}
              colorForeground={p.color.foreground}
              colorRole={p.color.role}
              description={p.description}
              links={p.links}
              code={p.code}
              tags={p.tags}
              screenshots={p.screenshots}
              videos={p.videos}
            />
          ))}
        </main>
        <footer className="sa-footer sa-surface-1-alt">
          <Container>
            <Row>
              <Col>
                <small>&copy; {new Date().getFullYear()}</small>
              </Col>
            </Row>
          </Container>
        </footer>
      </div>
    </>
  );
}

export default App;
