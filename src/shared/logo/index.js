import React from 'react'; 
import Responsive from '../responsive';

import './styles.css'; 

const Logo = () => (
  <>
    <Responsive minBreakpoint="md">
      <svg 
        version="1.1" 
        className="sa-logo" 
        xmlns="http://www.w3.org/2000/svg" 
        x="270px" 
        y="53px"
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
    </Responsive>
    <Responsive maxBreakpoint="md">
      {/* <svg className="sa-logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50.9 42.81">
        <title>saAsset 1</title>
        <g id="Layer_2" data-name="Layer 2">
          <g id="Layer_1-2" data-name="Layer 1">
            <text className="sa-name" transform="translate(2 33.05)">SA</text>
            <line className="sa-logo-border" x1="2" y1="2" x2="48.9" y2="2"/>
            <line className="sa-logo-border" x1="2" y1="39.98" x2="48.9" y2="39.98"/>
          </g>
        </g>
      </svg> */}
      <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 142 80">
        <text class="sa-name" transform="translate(.77 33.41)"><tspan x="0" y="0">SAMUEL</tspan></text>
        <line class="sa-name-tilde" x1="87.96" y1="40.41" x2="103.64" y2="40.41"/>
        <line class="sa-logo-border" x1="3.17" y1="2.41" x2="138.8" y2="2.41"/>
        <line class="sa-logo-border" x1="3.67" y1="40.41" x2="80.1" y2="40.41"/>
        <line class="sa-logo-border" x1="3.67" y1="77.59" x2="138.8" y2="77.59"/>
        <line class="sa-logo-border" x1="110.12" y1="40.41" x2="138.8" y2="40.41"/>
        <text class="sa-name" transform="translate(11.81 70.98)"><tspan x="0" y="0">ACUNA</tspan></text>
      </svg>
    </Responsive>
  </>
); 

export default Logo; 