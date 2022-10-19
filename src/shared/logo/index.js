import React from 'react'; 

import './styles.css'; 

const Logo = () => (
  <svg 
    version="1.1" 
    className="sa-logo" 
    xmlns="http://www.w3.org/2000/svg" 
    x="0px" 
    y="0px"
    viewBox="0 0 270 42.8"
  >
    <title>Samuel Acu&ntilde;a logo</title>
    <g>
      <g id="Header">
        <g id="Name">
          <g>
            <defs>
              <rect id="SVGID_1_" x="-4.1" y="-6" width="278" height="53"/>
            </defs>
            <clipPath id="SVGID_2_">
              <use href="#SVGID_1_" style={{overflow: "visible"}} />
            </clipPath>
          </g>
        </g>
      </g>
      <text transform="matrix(1 0 0 1 0 33)" className="sa-name">SAMUEL ACUNA</text>
      <line className="sa-name-tilde" x1="226.4" y1="2.3" x2="241.9" y2="2.3"/>
      <line className="sa-logo-border" x1="2.4" y1="2" x2="217" y2="2"/>
      <line className="sa-logo-border" x1="2.9" y1="40" x2="268" y2="40"/>
      <line className="sa-logo-border" x1="249.4" y1="2.3" x2="266.9" y2="2.3"/>
    </g>
  </svg>
); 

export default Logo; 