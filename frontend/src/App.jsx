import React, { useState, useEffect, useRef } from 'react';
import Navbar from './components/Navbar';
import Landing from './components/Landing';
import ProductCardSlider from './components/ProductCardSlider';
import Footer from './components/Footer';
import ProductPopup from './components/ProductPopup';

const App = () => {
  const [category, setCategory] = useState('');
  const [products, setProducts] = useState([]);
  const [selectedProduct, setSelectedProduct] = useState(null);
  

  const sliderRef = useRef(null);

  useEffect(() => {
    fetch('http://localhost/php/electronics/api_product_details.php')
      .then((res) => res.json())
      .then((data) => setProducts(data));
  }, []);

  const handleCategoryChange = (category) => {
    setCategory(category);
    if (sliderRef.current) {
      sliderRef.current.scrollIntoView({ behavior: 'smooth' });
    }
  };

  return (
    <div>
      <Navbar onCategoryChange={handleCategoryChange} products={products} onProductSelect={setSelectedProduct} />
      <Landing />
      <div ref={sliderRef}>
        <ProductCardSlider category={category} onProductSelect={setSelectedProduct} />
      </div>
      <Footer />
      {selectedProduct && <ProductPopup product={selectedProduct} onClose={() => setSelectedProduct(null)} />}
    </div>
  );
};

export default App;
