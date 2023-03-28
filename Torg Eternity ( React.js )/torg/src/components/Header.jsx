import React from 'react'
import logo from '../assets/home/logo.webp'
import '../styles/header.css'
import { Link } from 'react-router-dom'
import { useState } from 'react'

export default function Header(props) {
  const [isOpen, setIsOpen] = useState(false)

  function affMenu() {
    if (!isOpen) {
      setIsOpen(true)
    } else {
      setIsOpen(false)
    }
  }

  return (
    <header>
      <img src={logo} alt="Logo Torg Eternity" />
      <nav>
        <Link to="/" onClick={() => setIsOpen(false)}>
          Accueil
        </Link>
        <div>
          <Link onClick={affMenu}>Cosms</Link>
          {isOpen && (
            <div className="listcosms">
              <Link to="/cosm/aysle" onClick={affMenu}>
                Aysle
              </Link>
              <Link to="/cosm/cyberpapaute" onClick={affMenu}>
                La Cyberpapauté
              </Link>
              <Link to="/cosm/empiredunil" onClick={affMenu}>
                L'Empire du Nil
              </Link>
              <Link to="/cosm/orrorsh" onClick={affMenu}>
                Orrorsh
              </Link>
              <Link to="/cosm/panpacifica" onClick={affMenu}>
                Pan Pacifica
              </Link>
              <Link to="/cosm/terrevivante" onClick={affMenu}>
                La Terre Vivante
              </Link>
              <Link to="/cosm/tharkold" onClick={affMenu}>
                Tharkold
              </Link>
            </div>
          )}
        </div>
        <Link to="/map" onClick={() => setIsOpen(false)}>
          Carte du monde
        </Link>
        <Link to="/download" onClick={() => setIsOpen(false)}>
          Téléchargement
        </Link>
      </nav>
    </header>
  )
}
