import React, { useCallback, useEffect, useState } from 'react';
import PropTypes from 'prop-types';

const _breakpoints = {
  "min": 0,
  "md": 768,
  "max": Math.pow(10, 10)
};

const Responsive = ({ maxBreakpoint, minBreakpoint, children, ...props }) => {
  const [matchesMin, setMatchesMin] = useState(false);
  const [matchesMax, setMatchesMax] = useState(false);

  const toggleMin = (isMin) => {
    setMatchesMin(isMin.matches);
  };

  const toggleMax = (isMax) => {
    setMatchesMax(isMax.matches);
  };

  const setup = useCallback(() => {
    const isMin = window.matchMedia(`(min-width: ${_breakpoints[minBreakpoint]}px)`);
    const isMax = window.matchMedia(`(max-width: ${_breakpoints[maxBreakpoint]}px)`);

    toggleMin(isMin);
    toggleMax(isMax);

    isMin.addListener(toggleMin);
    isMax.addListener(toggleMax);
  }, [minBreakpoint, maxBreakpoint]);

  useEffect(() => {
    setup();
  }, [setup]);

  return (
    <>
      { matchesMin && matchesMax ? children : null }
    </>
  );
};

Responsive.propTypes = {
  children: PropTypes.any,
  maxBreakpoint: PropTypes.oneOf(Object.keys(_breakpoints)),
  minBreakpoint:  PropTypes.oneOf(Object.keys(_breakpoints))
};

Responsive.defaultProps = {
  children: <></>,
  maxBreakpoint: 'max',
  minBreakpoint: 'min'
};

export default Responsive;