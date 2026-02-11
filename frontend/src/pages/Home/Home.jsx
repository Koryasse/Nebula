import { Link } from 'react-router-dom'
import ColorBends from '../../components/ColorBends/ColorBends'
import './Home.css'

export default function Home() {
  return (
    <main className='home-main'>
      <section>
        <div className="color-bends-container">
          <ColorBends
            colors={["#ffffff"]}
            rotation={0}
            speed={0.2}
            scale={1}
            frequency={1}
            warpStrength={1}
            mouseInfluence={0}
            parallax={0.5}
            noise={0.05}
            transparent
          />
        </div>

        <div className="home-content">
          <h1>Nebula is a purpose-built tool for organizing and delivering work.</h1>
          <p>Meet the platform for modern work. Streamline tasks,
             projects, and team workflows effortlessly.</p>
          <div className="home-buttons">
            <Link className='cta-primary' to="/">Get Started</Link>
            <Link className='cta-secondary' to="/about">Learn More</Link>
          </div>
        </div>
      </section>
    </main>
  )
}
