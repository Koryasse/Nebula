import { useState } from 'react'
import { Link } from 'react-router-dom'
import Logo from '../../assets/nebulaLogo/nebulaBlack.svg'
import './Login.css'

function Login() {
  const handleLogin = async (e) => {
    e.preventDefault()

    await fetch("http://localhost:8000/login", {
      method: "POST",
      credentials: "include",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        email,
        password
      })
    })
  }

  return (
    <main className='login-main'>
      <section className='login-main-content'>
        <div>
          <div>
            <img src={Logo} alt="" />
            <h2>Welcome back</h2>
          </div>
          <form action="">
            <input type="email" placeholder="Enter email or username" />
            <input type="password" placeholder='Password' />
            <button>Continue</button>
          </form>
          <div>
            <p>By continuing, you agree to our 
              <Link to="/terms"> Terms </Link>
              and <Link to="/privacy">Privacy policy</Link>.
            </p>
            <p>Don't have an account? <Link to="/register">Sign up</Link></p>
          </div>
        </div>
      </section>
      <section className='login-bg'></section>
    </main>
  )
}

export default Login