import { useState } from 'react'
import './Contact.css'

function Contact() {

  return (
    <main className='contact-main'>
      <section>
        <div>
          <h1>Contact support</h1>
          <p>We are here to help. Ask product questions, report problems, or leave feedback.</p>
        </div>
        <div>
          <p>How can we help?</p>
          <div>
            <p>Please share any relevant information we may need to answer your question.</p>
            <form action="" method="post">
              <textarea name="" id="" cols="30" placeholder='How do I...'></textarea>
            </form>
            <div>
              <span>You can also email us at support@nebula.com</span>
              <button>Send message</button>
            </div>
          </div>
        </div>
      </section>
    </main>
  )
}

export default Contact