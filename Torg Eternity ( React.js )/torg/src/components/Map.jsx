import React, { useState } from 'react'
import '../styles/map.css'
import mapJ1 from '../assets/cartes/mapJ1.jpg'
import mapJ90 from '../assets/cartes/mapJ90.webp'

export default function Map() {
  
  const [isViewJ1, setIsViewJ1] = useState(true)
  const [isViewJ90, setIsViewJ90] = useState(false)

function affMap (jour) {
  if (jour === 1) {
    setIsViewJ1(true);
    setIsViewJ90(false);
  } else {
    setIsViewJ1(false);
    setIsViewJ90(true);
  }
}

  return (

    <section className='home'>
      <div>
        <h1 className='mainTitle'>&ensp;Carte du monde&ensp;</h1>
        <div className='boutons'>
          <h2 className='secondTitle'>Moment de l'invasion:</h2>
          <button onClick={()=> affMap(1)}>Jour 1</button>
          <button onClick={()=> affMap(90)}>Jour 90</button>
        </div>
        <div className='map'>
          {isViewJ1 && <img src={mapJ1} alt="Carte de l'invasion jour 1" />}
          {isViewJ90 && <img src={mapJ90} alt="Carte de l'invasion jour 90" />}
        </div>
      </div>
    </section>
  )
}
