import { BrowserRouter, Routes, Route } from 'react-router-dom'
import Home from './pages/Home/Home'
import About from './pages/About/About'
import Features from './pages/Features/Features'
import Pricing from './pages/Pricing/Pricing'
import Contact from './pages/Contact/Contact'
import Login from './pages/Login/Login'
import Register from './pages/Register/Register'
import LayoutWithNav from './layouts/LayoutWithNav'
import './App.css'

function App() {
  return (
    <BrowserRouter>
      <Routes>
        {/* Layout avec NavBar + Footer */}
        <Route element={<LayoutWithNav />}>
          <Route path='/' element={<Home />} />
          <Route path='/about' element={<About />} />
          <Route path='/features' element={<Features />} />
          <Route path='/pricing' element={<Pricing />} />
          <Route path='/contact' element={<Contact />} />
        </Route>

        {/* Pages sans NavBar / Footer */}
        <Route path='/login' element={<Login />} />
        <Route path='/register' element={<Register />} />
      </Routes>
    </BrowserRouter>
  )
}

export default App
