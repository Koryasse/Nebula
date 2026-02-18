import { useState } from 'react'
import './Contact.css'

function Contact() {

  return (
    <main className='contact-main'>
      <section className='contact-main-content'>
        <div>
          <div>
            <h1>Contact support</h1>
            <p>We are here to help. Ask product questions, report problems, or leave feedback.</p>
          </div>
        </div>
        <fieldset>
          <div className='contact-fieldset-header'>
            <span>How can we help?</span>
          </div>
          <div className='contact-fieldset-main'>
            <form action="" method="post">
              <label>Please share any relevant information we may need to answer your question.</label>
              <textarea name="" id="" cols="30" placeholder='How do I...'></textarea>
            </form>
          </div>
          <div className='contact-fieldset-footer'>
            <span>You can also email us at <a href="mailto:support@nebula.com">support@nebula.com</a></span>
            <button>Send message</button>
          </div>
        </fieldset>
      </section>
    </main>
  )
}

export default Contact