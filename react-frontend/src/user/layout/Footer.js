import React from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
import '../css/footer.css';

const Footer = props => {
    return(
        <footer>
            <div className="footer-container1">
                <div className="footer-container1-col1">
                    <div className="contact">
                        <h4>CONTACT US</h4>
                        <span>
                            <i className="fa-solid fa-location-dot" />
                            7th floor-35/6 D5 Str-Binh Thanh Dist-HCM city
                        </span>
                        <br /><br />
                        <span>
                            <i className="fa-solid fa-phone" />
                            (+84) 99 999 9999
                        </span>
                        <br /><br />
                        <span>
                            <i className="fa-solid fa-envelope" /> 
                            team1thebest@gmail.com
                        </span>
                    </div>
                    
                    <div className="openingtimes">
                        <h4>OPENING TIMES</h4>
                        <span>
                            <b>Weekdays</b> 07:30 - 22:30
                            <br /><br />
                            <b>Weekends</b> 07:00 - 22:30
                        </span>
                    </div>
                </div>

                <div className="footer-container1-col2">
                    <h4>LATEST BLOG</h4>
                    <span>
                        <i className="fa-brands fa-facebook-square" />
                        <Link to="#">@VNHP</Link> 
                        <br /><br />
                        <span className="blog">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, est labore deleniti eligendi officiis facere.</span> 
                        <Link to="#" className="link">https://buff.ly/2zaSfAQ</Link>
                        <br /><br />
                        <span className="date">12 May 2022</span>
                    </span>
                    <span>
                        <i className="fa-brands fa-facebook-square" />
                        <Link to="#">@VNHP</Link>
                        <br /><br />
                        <span className="blog">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, est labore deleniti eligendi officiis facere.</span> 
                        <Link to="#" className="link">https://buff.ly/2zaSfAQ</Link>
                        <br /><br />
                        <span className="date">12 May 2022</span> 
                    </span>
                </div>

                <div className="footer-container1-col3">
                    <h4>GALLERY</h4>
                    <div className="gallery1">
                        <img src={require('../img/footer/image-1.jpg')} alt="image1" className="gallery1__img1" />
                        <img src={require('../img/footer/image-2.jpg')} alt="image2" className="gallery1__img2" />
                        <img src={require('../img/footer/image-3.jpg')} alt="image3" className="gallery1__img3" />
                        <img src={require('../img/footer/image-7.jpg')} alt="image7" className="gallery1__img4" />
                        <img src={require('../img/footer/image-5.jpg')} alt="image5" className="gallery1__img5" />
                        <img src={require('../img/footer/image-9.jpg')} alt="image9" className="gallery1__img6" />
                        <img src={require('../img/footer/image-4.jpg')} alt="image4" className="gallery1__img7" />
                        <img src={require('../img/footer/image-8.jpg')} alt="image8" className="gallery1__img8" />
                        <img src={require('../img/footer/image-6.jpg')} alt="image6" className="gallery1__img9" />
                    </div>
                </div>
            </div>

            <div className="footer-containter2">
                <div className="footer-icon">
                    <Link to="#"><i className="fa-brands fa-facebook" /></Link>
                    <Link to="#"><i className="fa-brands fa-instagram-square" /></Link>
                    <Link to="#"><i className="fa-brands fa-twitter-square" /></Link>
                </div>
                <div className="sentence">
                    @ 2017 VNHP's Grocery. <Link to="#">Get The Theme</Link>
                </div>
            </div>
        </footer>
    )  
}

// Footer.defaultProps = {
    
// };

// Footer.PropsTypes = {
    
// };

export default Footer;