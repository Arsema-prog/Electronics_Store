import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faTimes } from '@fortawesome/free-solid-svg-icons';

const ProductPopup = ({ product, onClose }) => {
  return (
    <div className="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center p-4 transition-opacity duration-300 ease-in-out">
      <div className="absolute inset-0 bg-black bg-opacity-50 filter blur-sm"></div>
      <div className="relative bg-[#e0f7fa] rounded-lg shadow-lg p-4 md:p-6 max-w-sm md:max-w-3xl w-full z-10 transform transition-transform duration-300 ease-in-out scale-100 hover:scale-105">
        <div className="absolute top-2 right-2">
          <FontAwesomeIcon
            icon={faTimes}
            onClick={onClose}
            className="text-gray-600 text-2xl cursor-pointer hover:text-red-500 transition-colors duration-300"
          />
        </div>
        <div className="flex flex-col md:flex-row">
          <img
            src={product.image}
            alt={product.product_name}
            className="w-full md:w-1/2 h-48 md:h-64 object-cover rounded-lg transition-transform duration-300 transform hover:scale-105"
          />
          <div className="mt-4 md:mt-0 md:ml-6 space-y-2">
            <h2 className="text-xl md:text-3xl font-bold text-gray-900">Name of the product</h2>
            <h2 className="text-lg md:text-2xl text-gray-700 md:ml-16">{product.product_name}</h2>
            <p className="text-xl md:text-3xl font-bold text-gray-900">Description</p>
            <p className="text-sm md:text-lg text-gray-700 leading-relaxed">{product.description}</p>
            <p className="text-sm md:text-lg text-gray-600"><span className="text-md md:text-xl font-bold text-gray-900">Price:</span> ${product.price}</p>
            <p className="text-sm md:text-lg text-gray-600"><span className="text-md md:text-xl font-bold text-gray-900">Contact:</span> {product.email}</p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ProductPopup;
