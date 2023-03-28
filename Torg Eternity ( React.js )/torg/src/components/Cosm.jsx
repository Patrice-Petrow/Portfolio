import React from 'react'
import { useParams } from 'react-router-dom'
import { cosmDetails } from '../data/data.js'
import '../styles/cosm.css'

export default function Cosm() {
  const param = useParams()
 
  const detail = cosmDetails.filter((cosm) => {
    return cosm.id === param.nom
  })

  const description = detail[0].description.map((texte)=>{
      return <p>&emsp;{texte}</p>
  })
 console.log(description)
  return (
    <section className={detail[0].id}>
      <div className="name">
        <img className="logo" src={detail[0].logo} alt="Logo d'Aysle" />
        <h1>{detail[0].titre}</h1>
        <img className="logo" src={detail[0].logo} alt="Logo d'Aysle" />
      </div>

      <div className="cosm">
            <div className="axiomes">
          <h2>Axiomes</h2>
            <h3>&ensp;Magie: {detail[0].magie}</h3>
            <span className='detailAxiomes'>&emsp;{detail[0].magieDescription}</span>
            <h3>&ensp;Social: {detail[0].social}</h3>
            <span className='detailAxiomes'>&emsp;{detail[0].socialDescription}</span>
            <h3>&ensp;Spirituel: {detail[0].spirituel}</h3>
            <span className='detailAxiomes'>&emsp;{detail[0].spirituelDescription}</span>
            <h3>&ensp;Technologie: {detail[0].tech}</h3>
            <span className='detailAxiomes'>&emsp;{detail[0].techDescription}</span>
        </div>


        <div className="description">{description}</div>

        <div className="lord">
          <h2>{detail[0].nomSeigneur}</h2>
          <img src={detail[0].seigneur} alt="Seigneur Angar Uthorion" />
        </div>
      </div>
    </section>
  )
}
