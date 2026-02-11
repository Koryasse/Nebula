import { Link } from 'react-router-dom'
import LightRays from '../../components/LightRays/LightRays'
import Logo from '../../assets/nebulaLogo/nebulaWhite.svg'
import imgLeft from '../../assets/img/register-left-image.svg'
import './Register.css'

function Register() {
  return (
    <>
      <main className='register-main'>
        <section className='left-image'>
          <img src={imgLeft} alt="image left" />
        </section>
        
        <section className='register-content'>
          {/* Logo */}
          <div className='register-logo'>
            <img src={Logo} alt="Logo" />
          </div>

          {/* Form container */}
          <div className='register-form'>
            <div>
              <div>
                <h1>Inscrivez-vous</h1>
              </div>

              {/* Form */}
              <form action="post">
                <div>
                  <div>
                    <label htmlFor="email">E-mail</label>
                    <input type="email" id='email' name='email' />
                  </div>
                  <div>
                    <label htmlFor="username">Nom d'utilisateur</label>
                    <input type="text" id='username' name='username' />
                  </div>
                  <div>
                    <label htmlFor="password">Mot de passe</label>
                    <input type="password" id='password' name='password' />
                  </div>
                  <div>
                    <label htmlFor="passwordConfirm">Confirmer le mot de passe</label>
                    <input type="password" id='passwordConfirm' name='passwordConfirm' />
                  </div>
                  <button type='submit' name='submit'>S'inscrire</button>
                </div>
              </form>
              <div>
                <Link className='register-login-link' to="/login">Vous avez déjà un compte ?</Link>
              </div>
            </div>
          </div>
        </section>

        <section></section>
      </main>
    </>
  )
}

export default Register
