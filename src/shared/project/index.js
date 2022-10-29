import React, { useEffect, useRef } from 'react'; 
import { Container, Row, Col } from 'react-grid';
import YouTube from 'react-youtube'; 

import './styles.css';

const Project = ({ 
  title, 
  role, 
  imageAsset, 
  imageAlt,
  colorBackground,
  colorForeground,
  colorRole,
  description,
  links,
  code,
  tags,
  screenshots,
  videos,
  ...props 
}) => {
  const projectContainerRef = useRef(); 

  useEffect(() => {
    projectContainerRef.current.style.setProperty(
      '--sa-project-text-color',
      colorForeground
    ); 
    projectContainerRef.current.style.setProperty(
      '--sa-project-background-color',
      colorBackground
    ); 
  }, [colorBackground, colorForeground]); 
  
  return (
    <section className="sa-banner sa-project" ref={projectContainerRef}>
      <Container>
        <Row>
          <Col lg="6" md="8" sm="10" offset={{sm:1,md:2,lg:3}}>
            <img className="sa-project-logo" src={imageAsset} alt={imageAlt} />
            <h3 className="sa-project-title">{title}</h3>
            <span className="sa-project-role" style={{color: colorRole}}>{role}</span>
          </Col>
        </Row>
        <Row>
          <Col lg="6" md="8" sm="10" offset={{sm:1,md:2,lg:3}}>
            <div className="sa-project-description">
              {description
                ? description.map((d,i) => <p dangerouslySetInnerHTML={{__html: d}} key={i}></p>)
                : null
              }
            </div>
            <div className="sa-project-links">
              {links 
                ? links.map((a, i) => (
                  <>
                    <a href={a.href} target="_blank" rel="noopener noreferrer" key={i}>{a.label} &raquo;</a>
                    {(i < links.length - 1) ? "|" : null}
                  </>
                ))
                : null 
              }
            </div>
            <div className="sa-code">
              {code 
                ? code.map((c, i) => (
                  <code key={i}>{c}</code>
                ))
                : null
              }
            </div>
            <ul className="sa-pills">
              {tags 
                ? tags.map((t, i) => (
                  <li className="sa-pill" key={i}>#{t}</li>
                ))
                : null 
              }
            </ul>
          </Col>
        </Row>
        {screenshots
          ? <Row>
            <Col lg="6" md="8" sm="10" offset={{sm:1,md:2,lg:3}}>
              <div className="sa-project-pics">
                {screenshots.map((s, i) => (
                  <img className="sa-project-pic" src={s.asset} alt={s.alt} />
                ))}
              </div>
            </Col>
          </Row>
          : null 
        }
        {videos
          ? <Row>
            <Col xs="12">
              <div className="sa-project-pics">
                {videos.map((v, i) => (
                  <div className="sa-project-video" key={i}>
                    <YouTube videoId={v} />
                  </div> 
                ))}
              </div>
            </Col>
          </Row>
          : null 
        }
        
      </Container>
    </section>
  ); 
}; 

export default Project; 