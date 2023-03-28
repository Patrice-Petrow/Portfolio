import React from 'react'
import '../styles/download.css'
import preview from '../assets/files/preview.webp'
import fdp from '../assets/files/feuille_de_personnage.pdf'
import fdpe from '../assets/files/feuille_de_personnage_editable.pdf'
import previewTapis from '../assets/files/previewTapis.webp'
import tapis from '../assets/files/tapis.pdf'

export default function Download() {
  return (
    <section className="home">
      <h1 className="mainTitle">&ensp;Téléchargement&ensp;</h1>
      <div className="download">
        <div className="file">
          <img
            src={preview}
            alt="Aperçu de la feuille de personnage"
            className="preview"
          />
          <div className='subFile'>
            <h2 className='secondTitle'>Feuille de personnage</h2>
            <a
              href={fdp}
              download="feuille_de_personnage.pdf"
            >
              Télécharger
            </a>
          </div>
        </div>
        <div className="file">
          <img
            src={preview}
            alt="Aperçu de la feuille de personnage"
            className="preview"
          />
          <div className='subFile'>
            <h2 className='secondTitle'>Feuille de personnage éditable</h2>
            <a
              href={fdpe}
              download="feuille_de_personnage_editable.pdf"
            >
              Télécharger
            </a>
          </div>
        </div>
      </div>
      <div className="download">
      <div className="file">
          <img
            src={previewTapis}
            alt="Aperçu du tapis de jeu"
            className="preview"
          />
          <div className='subFile'>
            <h2 className='secondTitle'>Aide de jeu: tapis</h2>
            <a
              href={tapis}
              download="tapis.pdf"
            >
              Télécharger
            </a>
          </div>
        </div>

      </div>
    </section>
  )
}
