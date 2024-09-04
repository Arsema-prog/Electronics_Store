import React, { useState, useEffect } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faTimes, faBars } from '@fortawesome/free-solid-svg-icons';
import { Link } from 'react-router-dom';

const Navbar = ({ onCategoryChange, products, onProductSelect }) => {
  const [searchTerm, setSearchTerm] = useState('');
  const [searchResults, setSearchResults] = useState([]);
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  useEffect(() => {
    if (searchTerm) {
      const results = products.filter((product) =>
        product.product_name.toLowerCase().includes(searchTerm.toLowerCase())
      );
      setSearchResults(results);
    } else {
      setSearchResults([]);
    }
  }, [searchTerm, products]);

  const clearSearch = () => {
    setSearchTerm('');
    setSearchResults([]);
  };

  const toggleMenu = () => {
    setIsMenuOpen(!isMenuOpen);
  };

  return (
    <nav className="flex flex-col md:flex-row justify-between items-center p-4 bg-[#CBD0D8] text-white fixed top-0 left-0 right-0 z-50">
      <div className="text-xl md:text-2xl lg:text-3xl text-black font-bold"><a href="/">Electronics Shop</a></div>
      
      {/* Hamburger Icon for Mobile */}
      <div className="md:hidden flex items-center">
        <FontAwesomeIcon
          icon={isMenuOpen ? faTimes : faBars}
          onClick={toggleMenu}
          className="text-2xl cursor-pointer"
        />
      </div>
      
      {/* Categories List */}
      <ul
        className={`${
          isMenuOpen ? 'block' : 'hidden'
        } md:flex space-x-4 md:space-x-6 lg:space-x-8 mt-2 md:mt-0 bg-gray-400 md:bg-transparent absolute md:relative top-16 md:top-0 left-0 w-full md:w-auto p-4 md:p-0 z-40 md:z-auto`}
      >
        {['Laptop', 'Phone', 'Watch', 'Perfume'].map((category) => (
          <li
            key={category}
            onClick={() => {
              onCategoryChange(category);
              setIsMenuOpen(false); 
            }}
            className="cursor-pointer text-black hover:text-gray-400 text-lg md:text-base lg:text-lg py-2 md:py-0 md:px-2"
          >
            {category}
          </li>
        ))}
      </ul>

      {/* Search Bar */}
      <div className="relative mt-2 md:mt-0 w-full md:w-64 lg:w-80">
        <input
          type="text"
          value={searchTerm}
          onChange={(e) => setSearchTerm(e.target.value)}
          className="py-1 px-2 rounded-lg bg-[#CBD0D8]-700 text-black w-full"
          placeholder="Search products..."
        />
        {searchTerm && (
          <FontAwesomeIcon
            icon={faTimes}
            onClick={clearSearch}
            className="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-400"
          />
        )}
        {searchTerm && searchResults.length > 0 && (
          <ul className="absolute bg-white text-black mt-1 rounded shadow-lg w-full z-10">
            {searchResults.map((result) => (
              <li
                key={result.id}
                onClick={() => {
                  onProductSelect(result);
                  clearSearch(); // Clear search after selection
                }}
                className="px-4 py-2 hover:bg-gray-200 cursor-pointer"
              >
                {result.product_name}
              </li>
            ))}
          </ul>
        )}
      </div>
    </nav>
  );
};

export default Navbar;
