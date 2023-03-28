import '../styles/App.css';
import Header from './Header';
import { Routes, Route } from 'react-router-dom';
import Home from './Home'
import Cosm from './Cosm'
import Map from './Map'
import Download from './Download'
import Footer from './Footer';


function App() {

  return (
    <div className="App">
      <Header />
      <Routes>
        <Route path='/' element={<Home />} />
        <Route path='/cosm/:nom' element={<Cosm />} />
        <Route path='/cosm/*' element={<Home />} />
        <Route path='/map' element={<Map />} />
        <Route path='/download' element={<Download />} />
      </Routes>
      <Footer />
    </div>
  );
}

export default App;
