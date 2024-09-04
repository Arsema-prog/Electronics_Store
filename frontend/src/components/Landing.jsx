import React, { useState, useEffect } from 'react';
import background1 from '../assets/background7.mp4';
import background2 from '../assets/background2.mp4';
import background3 from '../assets/background3.mp4';
import background4 from '../assets/background4.mp4';

const videoSources = [background4, background1, background2, background3];

const Landing = () => {
  const [currentIndex, setCurrentIndex] = useState(0);
  const [key, setKey] = useState(0);

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentIndex((prevIndex) => (prevIndex + 1) % videoSources.length);
      setKey((prevKey) => prevKey + 1);
    }, 5000);

    return () => clearInterval(interval);
  }, []);

  return (
    <div className="relative h-[50vh] sm:h-[40vh] md:h-[80vh] lg:h-[100vh] w-full">
      <video
        key={key}
        autoPlay
        muted
        loop
        className="absolute inset-0 w-full h-full object-cover"
      >
        <source src={videoSources[currentIndex]} type="video/mp4" />
      </video>
      <div className="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <h1 className="text-2xl sm:text-3xl md:text-5xl lg:text-6xl font-bold text-white animate-bounce text-center px-4">
          Welcome to Our Shop
        </h1>
      </div>
    </div>
  );
};

export default Landing;
