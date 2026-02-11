import NavBar from '../components/NavBar/NavBar'
import Footer from '../components/Footer/Footer'
import { Outlet } from 'react-router-dom'

const LayoutWithNav = () => {
  return (
    <>
      <NavBar />
      <Outlet />  {/* Ici s’affichent les pages enfants */}
      <Footer />
    </>
  )
}

export default LayoutWithNav
