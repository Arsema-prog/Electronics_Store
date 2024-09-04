import React, { useState, useEffect } from 'react';

const ProductCardSlider = ({ category, onProductSelect }) => {
  const [products, setProducts] = useState([]);
  const [displayedProducts, setDisplayedProducts] = useState([]);
  let itemsPerPage;

if (window.innerWidth <= 550) {
    itemsPerPage = 1; // For very small screens
} else if (window.innerWidth <= 850) {
    itemsPerPage = 2; // For small screens
}
else if (window.innerWidth <= 1050) {
  itemsPerPage = 3; // For small screens
}
else if (window.innerWidth >= 1100) {
    itemsPerPage = 4; // For medium screens
} 
// else {
//     itemsPerPage = 6; 
// }


  // Fetch products on component mount
  useEffect(() => {
    fetch('http://localhost/php/electronics/api_product_details.php')
      .then((res) => res.json())
      .then((data) => setProducts(data));
  }, []);

  // Filter products whenever category or products change
  useEffect(() => {
    const filteredProducts = category
      ? products.filter((product) =>
          product.category.toLowerCase().includes(category.toLowerCase())
        )
      : products;

    setDisplayedProducts(filteredProducts.slice(0, itemsPerPage)); // Initialize with first set of filtered products
  }, [category, products, itemsPerPage]);

  // Circularly move to the next set of products
  const nextSlide = () => {
    setDisplayedProducts((prevDisplayed) => {
      const filteredProducts = category
        ? products.filter((product) =>
            product.category.toLowerCase().includes(category.toLowerCase())
          )
        : products;

      const nextProduct = filteredProducts[(filteredProducts.indexOf(prevDisplayed[prevDisplayed.length - 1]) + 1) % filteredProducts.length];
      return [...prevDisplayed.slice(1), nextProduct];
    });
  };

  // Circularly move to the previous set of products
  const prevSlide = () => {
    setDisplayedProducts((prevDisplayed) => {
      const filteredProducts = category
        ? products.filter((product) =>
            product.category.toLowerCase().includes(category.toLowerCase())
          )
        : products;

      const prevProductIndex = (filteredProducts.indexOf(prevDisplayed[0]) - 1 + filteredProducts.length) % filteredProducts.length;
      const prevProduct = filteredProducts[prevProductIndex];
      return [prevProduct, ...prevDisplayed.slice(0, -1)];
    });
  };

  return (
    <div className="relative mt-12 mb-12">
      <h2 className="text-5xl font-bold text-center mb-10 text-gray-800">Featured Products</h2>

      <div className="flex justify-center items-center gap-10 " >
        {displayedProducts.map((product, index) => (
          <div key={index} className="flex-shrink-0 w-64"> 
            <div className="bg-gray-100 p-2 rounded-lg shadow-md mb-4 transition-transform duration-300 transform hover:scale-105 hover:brightness-100 hover:shadow-xl"> 
              <div className="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col h-full">
                <div className="flex-shrink-0 relative">
                  <img
                    src={product.image}
                    alt={product.product_name}
                    className="w-full h-48 object-cover transition-transform duration-300 transform hover:scale-105 hover:brightness-90 hover:shadow-xl"
                  />
                </div>
                <div className="bg-gray-200 p-4 flex flex-col flex-grow"> 
                  <h3 className="text-lg font-semibold text-gray-800 mb-2">{product.product_name}</h3>
                  <button
                    onClick={() => onProductSelect(product)}
                    className="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-600"
                  >
                    See More
                  </button>
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>

      <button
        className="absolute top-1/2 left-2 sm:left-4 lg:left-8 transform -translate-y-1/2 bg-blue-500 text-white p-1 sm:p-2 rounded-full hover:bg-gray-600 transition duration-300"
        onClick={prevSlide}
      >
        &#10094;
      </button>
      <button
        className="absolute top-1/2 right-2 sm:right-4 lg:right-8 transform -translate-y-1/2 bg-blue-500 text-white p-1 sm:p-2 rounded-full hover:bg-gray-600 transition duration-300"
        onClick={nextSlide}
      >
        &#10095;
      </button>

    </div>
  );
};

export default ProductCardSlider;
