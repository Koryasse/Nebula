import { useState } from 'react'
import { Link } from 'react-router-dom'
import imgRight from '../../assets/img/register-right-image.svg'
import Logo from '../../assets/nebulaLogo/nebulaWhite.svg'
import './Login.css'

function Login() {

  return (
    <>
      <main>
        <section></section>

        <section className='login-content'>
          {/* Logo */}
          <div className='login-logo'>
            <img src={Logo} alt="Logo" />
          </div>

          {/* Form container */}
          <div className='login-form'>
            <div>
              <div>
                <h1>Connectez-vous</h1>
              </div>

              {/* Form */}
              <form action="post">
                <div>
                  <div>
                    <label htmlFor="email">E-mail</label>
                    <input type="email" id='email' name='email' />
                  </div>
                  <div>
                    <label htmlFor="password">Mot de passe</label>
                    <input type="password" id='password' name='password' />
                  </div>
                  <button type='submit' name='submit'>Se connecter</button>
                </div>
              </form>
              <div>
                <Link className='login-register-link' to="/login">Pas de compte ?</Link>
              </div>
            </div>
          </div>
        </section>

        <section className='right-image'>
          <img src={imgRight} alt="image right" />
        </section>
      </main>
    </>
  )
}

export default Login