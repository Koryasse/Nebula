import { useState } from 'react';
import { Link } from 'react-router-dom';
import Logo from '../../assets/nebulaLogo/nebulaWhite.svg';
import './NavBar.css';

function NavBar() {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <header>
      <nav>
        {/* Logo */}
        <div className="nav-left">
          <Link to="/">
            <img className="nav-logo" src={Logo} alt="Logo" />
          </Link>
        </div>

        {/* Menu Links */}
        <div className={`nav-center ${isOpen ? 'open' : ''}`}>
          <Link className='nav-link' to="/about">About</Link>
          <Link className='nav-link' to="/features">Features</Link>
          <Link className='nav-link' to="/pricing">Pricing</Link>
          <Link className='nav-link' to="/contact">Contact</Link>
        </div>

        {/* Auth Links */}
        <div className={`nav-right ${isOpen ? 'open' : ''}`}>
          <Link className='nav-link' to="/login">Login</Link>
          <Link className='nav-link-register' to="/register">Sign up</Link>
        </div>

        {/* Hamburger */}
        <div className="nav-hamburger" onClick={() => setIsOpen(!isOpen)}>
          <span className={`line ${isOpen ? 'top' : ''}`}></span>
          <span className={`line ${isOpen ? 'middle' : ''}`}></span>
          <span className={`line ${isOpen ? 'bottom' : ''}`}></span>
        </div>
      </nav>
    </header>
  );
}

export default NavBar;
