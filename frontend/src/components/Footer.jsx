import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faTwitter, faFacebook, faInstagram } from '@fortawesome/free-brands-svg-icons';

const Footer = () => {
  return (
    <footer className="bg-gray-800 text-white text-center p-4">
      <div className="mb-4 flex justify-center space-x-4 sm:space-x-6 md:space-x-8 lg:space-x-10">
        <a href="https://twitter.com" className="hover:text-blue-400">
          <FontAwesomeIcon icon={faTwitter} size="lg" className="sm:text-2xl md:text-3xl lg:text-4xl" />
        </a>
        <a href="https://facebook.com" className="hover:text-blue-600">
          <FontAwesomeIcon icon={faFacebook} size="lg" className="sm:text-2xl md:text-3xl lg:text-4xl" />
        </a>
        <a href="https://instagram.com" className="hover:text-pink-500">
          <FontAwesomeIcon icon={faInstagram} size="lg" className="sm:text-2xl md:text-3xl lg:text-4xl" />
        </a>
      </div>
      <p className="text-sm sm:text-base md:text-lg lg:text-xl">&copy; 2024 Electronics Shop. All rights reserved.</p>
    </footer>
  );
};

export default Footer;
