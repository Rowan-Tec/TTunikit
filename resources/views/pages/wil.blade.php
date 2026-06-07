@extends('layouts.app')
@section('title', 'TT UNIK IT SOLUTIONS | Work Integrated Learning')
@section('description', 'TT UNIK IT SOLUTIONS provide Work Integrated Learning which is designed for ICT, MEDIA, FINANCE AND BUSINESS ADMINISTRATION. ')
@section('keywords', 'Work Integrated Learning, WIL, TUT WIL, UNISA WIL, UJ WIL')
@section('content')

<style>
  html,
  body,
  .layout-wrapper,
  .layout-page,
  .content-wrapper {
    max-width: 100%;
    overflow-x: hidden;
  }

  #carouselExampleAutoplaying,
  #carouselExampleAutoplaying img {
    max-width: 100%;
  }
</style>

<style>
    
    
    
    /* MSHD Global Theme Styles */

:root {
--mshd-maroon: #851c3b;
--mshd-maroon-light: #a52345;
--mshd-maroon-gradient: linear-gradient(135deg, #851c3b 0%, #a52345 50%, #d13a5c 100%);
--mshd-dark-bg: #1a1d21;
}

/* Global Shimmer Overlay */
#shimmer-overlay {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background: rgba(255, 255, 255, 0.9);
backdrop-filter: blur(10px);
-webkit-backdrop-filter: blur(10px);
z-index: 10000;
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
transition: opacity 0.5s ease;
}

.dark-style #shimmer-overlay {
background: #1a1d21;
}

.shimmer-loader {
display: flex;
gap: 10px;
margin-bottom: 20px;
}

.shimmer-loader span {
width: 15px;
height: 15px;
background: var(--mshd-maroon-gradient);
border-radius: 50%;
animation: shimmer-bounce 1.4s infinite ease-in-out;
}

.shimmer-loader span:nth-child(2) {
animation-delay: 0.2s;
}

.shimmer-loader span:nth-child(3) {
animation-delay: 0.4s;
}

@keyframes shimmer-bounce {

0%,
80%,
100% {
transform: scale(0);
opacity: 0.5;
}

40% {
transform: scale(1);
opacity: 1;
}
}

.shimmer-text {
color: #566a7f;
font-size: 14px;
font-weight: 500;
}

.dark-style .shimmer-text {
color: rgba(255, 255, 255, 0.7);
}



/* Global Button Styles */
.follow-btn,
.play-music-btn,
.btn-primary-mshd {
background-color: var(--mshd-maroon) !important;
border-color: var(--mshd-maroon) !important;
color: #fff !important;
border-radius: 25px;
transition: all 0.3s ease;
}

.follow-btn:hover,
.play-music-btn:hover,
.btn-primary-mshd:hover {
background-color: var(--mshd-maroon-light) !important;
transform: scale(1.05);
}

/* Follow Button Specifics */
.follow-btn {
display: flex !important;
align-items: center;
padding: 2px 8px 2px 2px !important;
}

.follow-count {
background-color: #fff;
color: #000;
border-radius: 500px;
padding: 2px 6px;
margin-right: 8px;
font-size: 10px;
}

.follow-btn.active {
background-color: #f0fff0 !important;
color: green !important;
border-color: green !important;
}

.follow-btn.active .follow-count {
background-color: green;
color: #fff;
}

/* Player UI Components */
.play-btn-circle {
width: 60px;
height: 60px;
background: linear-gradient(72.47deg, #26050c 22.16%, rgb(126, 58, 78) 76.47%) !important;
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
color: #fff;
font-size: 22px;
box-shadow: 0 5px 20px rgba(133, 28, 59, 0.5);
transition: transform 0.3s ease;
}

.play-btn-circle:hover {
transform: scale(1.1);
}

.track-icon {
width: 40px;
height: 40px;
background: var(--mshd-maroon-gradient);
border-radius: 10px;
display: flex;
align-items: center;
justify-content: center;
color: #fff;
}

/* Utility Classes */
.mshdlogo {
background: url('/images/mshdlogo.fw.png') no-repeat center;
background-size: contain;
width: 38px;
height: 38px;
}

.skeleton-loader {
width: 100%;
height: 100%;
display: flex;
align-items: center;
justify-content: center;
background: rgba(0, 0, 0, 0.05);
}

.text-maroon {
color: var(--mshd-maroon) !important;
}

.bg-maroon {
background-color: var(--mshd-maroon) !important;
}

/* Persistent Bottom Player */
.persistent-player {
position: fixed;
bottom: -100px;
left: 0;
right: 0;
background: linear-gradient(135deg, #1e2235 0%, #2a2f3a 100%);
border-top: 1px solid rgba(255, 255, 255, 0.1);
padding: 10px 20px;
z-index: 9999;
display: flex;
align-items: center;
gap: 15px;
box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.3);
transition: bottom 0.3s ease;
}

.persistent-player.active {
bottom: 0;
}

.persistent-player .player-artwork {
width: 50px;
height: 50px;
border-radius: 8px;
object-fit: cover;
}

.persistent-player .player-info {
flex: 1;
min-width: 0;
}

.persistent-player .player-title {
color: #fff;
font-size: 14px;
font-weight: 600;
margin: 0;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
}

.persistent-player .player-artist {
color: rgba(255, 255, 255, 0.6);
font-size: 12px;
margin: 0;
}

.persistent-player .player-controls {
display: flex;
align-items: center;
gap: 10px;
}

.persistent-player .player-btn {
background: none;
border: none;
color: #fff;
font-size: 18px;
cursor: pointer;
padding: 8px;
transition: all 0.2s ease;
}

.persistent-player .player-btn:hover {
color: var(--mshd-maroon);
}

.persistent-player .player-btn.play-btn {
width: 45px;
height: 45px;
background: var(--mshd-maroon-gradient);
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
font-size: 16px;
}

.persistent-player .player-btn.play-btn:hover {
color: #fff;
transform: scale(1.1);
}

/* Up Next Queue Panel */
.up-next-panel {
position: absolute;
bottom: 100%;
right: 20px;
width: 320px;
max-height: 400px;
background: linear-gradient(145deg, #2a2f3a 0%, #1e2235 100%);
border-radius: 16px 16px 0 0;
box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.4);
overflow: hidden;
display: none;
z-index: 10000;
}

.up-next-panel.active {
display: block;
animation: slideUp 0.3s ease;
}

@keyframes slideUp {
from {
transform: translateY(20px);
opacity: 0;
}

to {
transform: translateY(0);
opacity: 1;
}
}

.up-next-header {
display: flex;
justify-content: space-between;
align-items: center;
padding: 15px 20px;
background: var(--mshd-maroon-gradient);
color: #fff;
font-weight: 600;
font-size: 14px;
}

.up-next-list {
max-height: 300px;
overflow-y: auto;
}

.up-next-item {
display: flex;
align-items: center;
gap: 12px;
padding: 12px 20px;
cursor: pointer;
transition: background 0.2s ease;
border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.up-next-item:hover {
background: rgba(133, 28, 59, 0.2);
}

.up-next-thumb {
width: 45px;
height: 45px;
border-radius: 8px;
object-fit: cover;
}

.up-next-info {
flex: 1;
min-width: 0;
}

.up-next-title {
color: #fff;
font-size: 13px;
font-weight: 500;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
}

/* Music Card Utilities */
.music-duration-badge {
position: absolute;
bottom: 10px;
right: 10px;
background: rgba(0, 0, 0, 0.8);
color: #fff;
padding: 3px 8px;
border-radius: 4px;
font-size: 11px;
font-weight: 500;
}

.play-overlay-center {
position: absolute;
top: 0;
left: 0;
right: 0;
bottom: 0;
background: rgba(0, 0, 0, 0.4);
display: flex;
align-items: center;
justify-content: center;
opacity: 0;
transition: opacity 0.3s ease;
cursor: pointer;
}

.card:hover .play-overlay-center {
opacity: 1;
}

.owner-avatar {
width: 40px;
height: 40px;
border-radius: 50%;
object-fit: cover;
border: 2px solid var(--mshd-maroon);
}

/* Event Page Premium Styles */
.border-top.border-maroon {
border-top: 3px solid var(--mshd-maroon) !important;
}

.event-image-wrapper {
    width: 100%;
    aspect-ratio: 16 / 9;
    overflow: hidden;
    position: relative;
    border-radius: 8px;
    background: #000;
    height: 161px;
}

.event-image-wrapper img {
width: 100%;
height: 100%;
object-fit: cover;
transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.card:hover .event-image-wrapper img {
transform: scale(1.1);
}

.cardposition-overlay {
position: absolute;
bottom: 0;
left: 0;
right: 0;
padding: 10px 15px;
background: rgba(0, 0, 0, 0.55);
/* Consistent Halka background */
backdrop-filter: blur(8px);
-webkit-backdrop-filter: blur(8px);
color: #fff;
font-size: 11px;
transition: all 0.3s ease;
z-index: 5;
min-height: 42px;
display: flex;
align-items: center;
}

.card:hover .cardposition-overlay {
background: rgba(0, 0, 0, 0.7);
}

.btn-maroon {
background-color:#022461 !important;
color: #fff !important;
border: none !important;
transition: all 0.3s ease;
}

.btn-maroon:hover {
background-color: #aa0e0a !important;
transform: translateY(-2px);
box-shadow: 0 4px 12px rgba(133, 28, 59, 0.3);
}

/* Global Maroon Helpers */
.text-maroon {
color: var(--mshd-maroon) !important;
}

.bg-maroon {
background-color: var(--mshd-maroon) !important;
}

/* Nav Pills Maroon Branding */
.nav-pills .nav-link.active,
.nav-pills .nav-link.active:hover,
.nav-pills .nav-link.active:focus {
background-color:#9a0808 !important;
color: #fff !important;
box-shadow: 0 2px 4px 0 rgba(133, 28, 59, 0.4);
}

.nav-pills .nav-link:hover {
color:#fff;
}

/* Accordion Maroon Branding */
.accordion-button:not(.collapsed) {
background-color: rgba(133, 28, 59, 0.05) !important;
color:#fff;
}

.accordion-button:after {
background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23851c3b'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
}

/* Sidebar Active Indicator Migration */
.layout-wrapper:not(.layout-horizontal) .bg-menu-theme .menu-inner>.menu-item.active:before {
background-color: var(--mshd-maroon) !important;
}

/* Ensure Active Text is visible and NO underline on hover */
.bg-menu-theme .menu-inner .menu-item .menu-link,
.bg-menu-theme .menu-inner .menu-item .menu-link:hover,
.bg-menu-theme .menu-inner .menu-item .menu-link:focus {
text-decoration: none !important;
}

.dark-style .bg-menu-theme .menu-inner>.menu-item.active>.menu-link {
color: #fff !important;
}



.bg-maroon-opacity {
background: rgba(133, 28, 59, 0.15) !important;
backdrop-filter: blur(8px);
border: 1px solid rgba(255, 255, 255, 0.1);
}

.bg-maroon-opacity i {
color: #fff !important;
}

.line-clamp-2 {
display: -webkit-box;
-webkit-line-clamp: 2;
line-clamp: 2;
-webkit-box-orient: vertical;
overflow: hidden;
}

.line-clamp-3 {
display: -webkit-box;
-webkit-line-clamp: 3;
line-clamp: 3;
-webkit-box-orient: vertical;
overflow: hidden;
}

.custom-scrollbar::-webkit-scrollbar {
width: 5px;
}

.custom-scrollbar::-webkit-scrollbar-track {
background: rgba(0, 0, 0, 0.05);
}

.custom-scrollbar::-webkit-scrollbar-thumb {
background: var(--mshd-maroon);
border-radius: 10px;
}

/* Home Page Styles extracted from home.php */

.slick-list.draggable .slick-track {
margin: 0;
}

.dark-style p.talent-text {
color: #000 !important;
}

/* Scoped .w-100 override to avoid breaking global layout */
.mshd-homepage .w-100 {
height: 120px;
object-fit: fill;
}

.mshd-homepage .space-padding {
padding-bottom: 7px;
}

.mshd-homepage .cardbg {
background: #33374d;
border: 1px solid #434968 !important;
}



.headbg {
background: #33374d;
}

.scrolldiv {
height: 450px;
overflow-y: scroll;
display: hidden;
}

.cardposition {
position: absolute;
bottom: 0px;
background: #000;
opacity: 0.9;
width: 100%;
--bs-card-spacer-y: 0.3rem;
}

.custom-dropdown {
color: #fff !important;
}

.custom-dropdown .dropdown-item {
color: #fff !important;
}

.custom-dropdown .dropdown-item:hover {
background-color: #44475b;
color: #fff !important;
}


.search-box input::placeholder {
color: #f8d7da;
}

.search-box button {
border: 1px solid white;
color: white;
}

.studio-btn {
color: white;
border: 1px solid white;
}

.studio-btn:hover {
color: #fff;
}

.studio-dropdown {
background-color: #e74c3c;
}

.studio-dropdown .dropdown-item {
color: white;
}

.studio-dropdown .dropdown-item:hover {
background-color: #c0392b;
color: #fff;
}

.slick-next {
right: 0px !important;
}

.slick-prev {
left: 0px !important;
}

.slick-prev,
.slick-next {
width: 20px;
height: 20px;
border-radius: 50%;
background: #5d5d5dbd !important;
color: #ffffff;
font-size: 12px;
padding: 0;
cursor: pointer;
display: flex !important;
align-items: center;
justify-content: center;
transition: all 0.3s ease;
z-index: 10;
border: none;
}

.slick-prev:before,
.slick-next:before {
font-family: 'FontAwesome';
font-size: 9px;
color: #ffffff;
line-height: 1;
}

.slick-prev:before {
content: '\f053';
}

.slick-next:before {
content: '\f054';
}

.top-bar .d-flex.align-items-center {
gap: 12px;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
display: none;
}

.slider-container {
width: 100%;
float: left;
}

.ad-box {
width: 13%;
background-color: #2a2f3a;
color: white;
text-align: center;
line-height: 400px;
float: right;
}

.card1 {
padding: 6px !important;
}

.slider .slick-slide:last-child .card1 {
margin-right: 0;
}

.lost-found-slider .slick-slide {
padding: 0 10px;
box-sizing: border-box;
}

.lost-found-slider .card {
margin: 0 auto;
height: 100%;
}

#lost_found_slider img.img-fluid.rounded-3.mb-3 {
height: 237px;
object-fit: contain;
}

.ad {
background: #fff;
color: #000;
padding: 20px;
border: 1px solid #ccc;
height: 316px;
box-sizing: border-box;
}

.card.profile-card {
border-radius: 8px;
box-shadow: 0 0.25rem 1.125rem rgba(75, 70, 92, 0.20);
}

#new-cards .card {
border: 1px solid #ffffff !important;
}

.card-img-cotainer {
height: 210px;
overflow: hidden;
}

.card-img-cotainer img {
height: 100%;
width: 100%;
object-fit: cover;
object-position: top;
}

.card-text {
font-size: 12px;
}

.models-slider .waves-light {
font-size: 12px;
padding: 3px 6px;
}



.card-body .talent-text {
margin: 0 !important;
}

.talent-text i {
font-size: 13px;
color: maroon;
}

img.card-logo {
height: 40px;
}

.thumbnails {
position: absolute;
top: 6%;
right: 11px;
overflow: hidden;
}

.card-image {
position: relative;
}

.mainImage-img {
height: 100%;
width: 100%;
}

.mshd-homepage .header-text {
line-height: 15px;
color: #000;
}

.mshd-homepage .brand-name {
font-size: 15px;
}

.mshd-homepage .talent-text {
font-size: 10px;
margin-top: 10px;
color: #000;
}

.mshd-homepage .post-date {
font-size: 10px;
color: #000;
}

.agency-contact-group {
display: flex;
align-items: center;
justify-content: space-between;
font-size: 12px;
margin-bottom: 10px;
color: #2f3349;
}

.mshd-homepage .card-content {
padding: 15px;
background-color: #fff;
position: relative;
}

.mshd-homepage .card-footer-custom {
padding: 20px;
background-color: #fff;
}

img.thumbnail-img {
height: 30px;
width: 37px;
object-fit: cover;
object-position: top;
margin-bottom: 10px;
border-radius: 6px;
cursor: pointer;
}

.mshd-homepage .footer-stats {
display: flex;
align-items: center;
justify-content: space-between;
font-size: 12px;
color: #000;
}

.mshd-homepage .footer-stats span {
cursor: pointer;
}


.dark-style .reaction-bar {
background-color: #232333 !important;
}

/* Music Page Specific Refactor */
.music-header {
border-radius: 15px;
padding: 2.5rem;
margin-bottom: 2.5rem;
background: var(--mshd-maroon-gradient);
color: #fff;
box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.dark-style .music-header {
background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
}

.search-filter-bar {
display: flex;
gap: 1rem;
margin-bottom: 2rem;
padding: 1.5rem;
background: #fff;
border-radius: 12px;
box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
flex-wrap: wrap;
align-items: center;
}

.dark-style .search-filter-bar {
background: #2b2c40;
box-shadow: none;
}

.search-input {
flex: 1;
min-width: 250px;
border: 1px solid #d9dee3;
border-radius: 8px;
padding: 0.6rem 1.2rem;
}

.filter-select {
min-width: 150px;
border: 1px solid #d9dee3;
border-radius: 8px;
appearance: none;
background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23697a8d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
background-repeat: no-repeat;
background-position: right 12px center;
}

.section-title {
font-size: 1.5rem;
font-weight: 700;
margin-bottom: 1.5rem;
display: flex;
align-items: center;
gap: 0.75rem;
}

.light-style .section-title {
color: #566a7f;
}

.dark-style .section-title {
color: #fff;
}

.section-title i {
color: var(--mshd-maroon);
}

.music-card-item .card {
transition: transform 0.3s ease, box-shadow 0.3s ease;
border-radius: 12px;
overflow: hidden;
}

.music-card-item:hover .card {
transform: translateY(-5px);
box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
}

.dark-style .music-card-item .card {
background-color: #2b2c40;
border: 1px solid #444564;
}

.dark-style .music-card-item .card-header {
border-bottom: 1px solid #444564;
background: transparent;
}

.dark-style .music-card-item .card-body {
background: transparent;
}

.no-songs-message {
text-align: center;
padding: 5rem 2rem;
opacity: 0.7;
}

.no-songs-message i {
font-size: 4rem;
margin-bottom: 1.5rem;
color: var(--mshd-maroon);
}


.mshd-homepage .footer-stats i {
font-size: 12px;
}

small.talent-summary {
font-size: 10px;
}

.media-count.text-end.mt-2.pe-2 {
position: absolute;
top: 81%;
right: 0;
color: #ffffff;
line-height: 9px;
padding: 5px;
background: rgba(0, 0, 0, 0.75);
}

small.media-stats {
font-weight: 900;
color: #ffffff;
font-size: 8px;
}

.card1 .card {
box-shadow: none;
}

.mshd-homepage nav.navbar {
box-shadow: 0 0 2px 0 rgb(0 0 0 / 22%) !important;
border-radius: 12px;
}

.mshd-homepage .search-container .form-control {
display: block;
width: 100%;
padding: 0.422rem 0.875rem;
font-size: 13px;
font-weight: 400;
line-height: 1.5;
height: 31px;
color: #6f6b7d;
background-color: #fff;
background-clip: padding-box;
border: 1px solid #dbdade;
appearance: none;
border-radius: 25px;
transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.mshd-homepage button.follow-btn {
position: absolute;
top: 15px;
right: 15px;
outline: none !important;
border: 1px solid #000000ff;
font-size: 12px;
background: #000;
color: #ffffffff;
border-radius: 25px;
display: flex;
align-items: center;
padding: 2px;
padding-right: 8px;
}

.follow-count {
background-color: #fff;
color: #000;
border-radius: 500px;
padding: 2px 6px;
margin-right: 8px;
font-size: 10px;
}

.follow-btn.active {
border-color: green;
background-color: #dbdbdb61;
color: green;
}

.claim-btn {
position: absolute;
top: 9px;
right: 15px;
outline: none;
border: 1px solid #515151;
font-size: 12px;
background: transparent;
color: #515151;
border-radius: 25px;
}

.claim-btn.active {
border-color: green;
color: green;
}

.mshd-homepage .card-content .talent-text {
display: -webkit-box;
-webkit-box-orient: vertical;
-webkit-line-clamp: 1 !important;
line-clamp: 1 !important;
overflow: hidden;
text-overflow: ellipsis;
margin-bottom: 0;
}

.mshd-homepage .card .talent-text {
display: -webkit-box;
-webkit-box-orient: vertical;
-webkit-line-clamp: 2;
line-clamp: 2;
overflow: hidden;
text-overflow: ellipsis;
}

.mshd-homepage .card a {
color: #000;
font-weight: 900;
text-decoration: none;
cursor: pointer;
font-size: 10px;
}

.lost-found-slider .waves-light {
font-size: 12px;
}

.alert-success {
background-color: #ddf6e8;
border-color: #ddf6e8;
color: #28c76f;
position: absolute;
top: 15px;
right: 15px;
width: 98px;
font-size: 9px;
padding: 6px;
}

.claimed {
background-color: #28a745 !important;
border-color: #28a745 !important;
color: #fff !important;
cursor: not-allowed !important;
opacity: 0.8 !important;
font-size: 20px;
}

.search-box {
position: relative;
}

.search-container {
position: relative;
width: 100%;
}

.search-container .clear-icon {
display: none;
/* Hidden by default */
}

.search-container .clear-icon:hover {
color: #851c3b;
/* Theme color on hover */
}

.search-container .d-none {
display: none !important;
}

.card.profile-card {
border-radius: 8px;
}

.card-img-cotainer {
height: 210px;
overflow: hidden;
}

.card-img-cotainer img {
height: 100%;
width: 100%;
object-fit: cover;
object-position: top;
}



.talent-text i {
font-size: 13px;
color: maroon;
}

img.card-logo {
height: 40px;
}

.card-image {
position: relative;
}

.mainImage-img {
height: 100%;
width: 100%;
}

.mshd-homepage .header-text {
line-height: 15px;
color: #000;
}

.mshd-homepage .brand-name {
font-size: 15px;
font-weight: 700;
}

.mshd-homepage .talent-text {
font-size: 10px;
margin-top: 10px;
color: #333;
display: -webkit-box;
-webkit-box-orient: vertical;
-webkit-line-clamp: 2;
line-clamp: 2;
overflow: hidden;
text-overflow: ellipsis;
}

.card-content {
padding: 15px;
background-color: #fff;
position: relative;
}

.card-footer-custom {
padding: 15px;
background-color: #f2f2f2;
border-top: 2px solid #e6b7c6;
}

.card-img-cotainer {
border-top: 2px solid #e6b7c6;
border-bottom: 2px solid #e6b7c6;
}

.footer-stats {
display: flex;
align-items: center;
justify-content: space-between;
font-size: 12px;
color: #000;
}

.footer-stats i {
font-size: 12px;
color: #851c3b;
}

small.talent-summary {
font-size: 10px;
color: #666;
}

button.follow-btn {
position: absolute;
top: 15px;
right: 15px;
outline: none !important;
border: 1px solid #000;
font-size: 12px;
background: #000;
color: #fff;
border-radius: 25px;
display: flex;
align-items: center;
padding: 2px;
padding-right: 8px;
transition: all 0.3s ease;
}

.follow-count {
background-color: #fff;
color: #000;
border-radius: 500px;
padding: 2px 6px;
margin-right: 8px;
font-size: 10px;
}

.follow-btn.active {
border-color: green;
background-color: #f0fff0;
color: green;
}

.follow-btn.active .follow-count {
background-color: green;
color: #fff;
}

.nav-container i {
color: maroon;
background-color: #fff;
box-shadow: 0 0 2px 0 rgb(0 0 0 / 22%) !important;
height: 35px;
font-size: 14px;
align-items: center;
display: flex;
width: 35px;
justify-content: center;
border-radius: 500px;
margin-right: 10px;
}

.filter-container {
margin-left: 10px;
}

.filter-container select.form-control {
height: 31px;
font-size: 13px;
border-radius: 25px;
padding: 0 15px;
}

@media screen and (max-width: 768px) {
.filter-container {
width: 100%;
margin-left: 0;
margin-bottom: 10px;
}

.presenters-slider .card1 {
padding: 0 5px;
}
}

.d-flex.align-items-center.g-3 i.fas.fa-search-location {
margin-right: 10px;
font-size: 20px;
}

.d-flex.align-items-center.g-3 i.fas.fa-users {
margin-right: 10px;
font-size: 20px;
}

.d-flex.align-items-center.g-3 i.fa-solid.fa-user-large {
margin-right: 10px;
font-size: 20px;
}

a.navbar-brand {
margin-right: 5px !important;
}

@media screen and (max-width: 1280px) {
.artist-img {
height: 203px !important;
}

.card-img-top {
height: 186px !important;
}

.small {
font-size: 10px !important;
}

.news-img {
height: 198px !important;
}

span {
font-size: 9px !important;
}

.waves-effect {
font-size: 10px !important;
padding: 4px !important;
}
}

@media screen and (max-width: 576px) {
.top-bar.d-flex.justify-content-between.px-4 {
padding: 10px;
margin-left: 10px;
align-items: flex-start !important;
justify-content: center !important;
flex-direction: column;
gap: 10px;
}

.waves-effect {
font-size: 10px !important;
padding: 4px !important;
}

.small {
font-size: 10px !important;
}

span {
font-size: 10px !important;
}

.artist-img {
height: 219px !important;
}

.card-img-top {
height: 205px !important;
}

.news-img {
height: 208px !important;
}
}

/* Prevent FOUC (Flash of Unstyled Content) for Slick Sliders */
.slider:not(.slick-initialized) {
display: flex;
overflow: hidden;
}

.slider:not(.slick-initialized)>div {
display: block;
width: 25%;
/* Default 4 slides */
flex-shrink: 0;
padding: 0 10px;
box-sizing: border-box;
}

@media screen and (max-width: 1200px) {
.slider:not(.slick-initialized)>div {
width: 33.33%;
/* 3 slides */
}
}

@media screen and (max-width: 992px) {
.slider:not(.slick-initialized)>div {
width: 50%;
/* 2 slides */
}
}

@media screen and (max-width: 576px) {
.slider:not(.slick-initialized)>div {
width: 100%;
/* 1 slide */
}
}

/* Music Card Styles from music_public.php */
.track-icon {
width: 40px;
height: 40px;
background: linear-gradient(135deg, #851c3b 0%, #e94560 100%);
border-radius: 10px;
display: flex;
align-items: center;
justify-content: center;
color: #fff;
font-size: 16px;
}

.play-overlay-center {
position: absolute;
top: 0;
left: 0;
right: 0;
bottom: 0;
background: rgba(0, 0, 0, 0.4);
display: flex;
align-items: center;
justify-content: center;
opacity: 0;
transition: opacity 0.3s ease;
cursor: pointer;
}

.card-img-cotainer:hover .play-overlay-center {
opacity: 1;
}

.play-btn-circle {
width: 60px;
height: 60px;
background: linear-gradient(135deg, #851c3b 0%, #e94560 100%);
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
color: #fff;
font-size: 22px;
box-shadow: 0 5px 20px rgba(133, 28, 59, 0.5);
transition: transform 0.3s ease;
}

.play-btn-circle:hover {
transform: scale(1.1);
}

.music-duration-badge {
position: absolute;
bottom: 10px;
right: 10px;
background: rgba(0, 0, 0, 0.8);
color: #fff;
padding: 3px 8px;
border-radius: 4px;
font-size: 11px;
font-weight: 500;
}

.owner-section {
display: flex;
align-items: center;
gap: 10px;
padding-bottom: 12px;
margin-bottom: 12px;
border-bottom: 1px solid rgba(0, 0, 0, 0.1);
cursor: pointer;
transition: all 0.2s ease;
}

.owner-section:hover {
opacity: 0.8;
}

.owner-avatar {
width: 40px;
height: 40px;
border-radius: 50%;
object-fit: cover;
border: 2px solid #851c3b;
}

.owner-info {
display: flex;
flex-direction: column;
}

.owner-name {
font-size: 13px;
font-weight: 600;
color: #333;
}

.upload-date-small {
font-size: 10px;
color: #6c757d;
}

.upload-date-small i {
color: #851c3b;
}

.reaction-footer {
display: flex;
align-items: center;
justify-content: space-between;
gap: 8px;
}

.reaction-item {
display: flex;
align-items: center;
gap: 5px;
font-size: 12px;
color: #666;
cursor: pointer;
padding: 5px 8px;
border-radius: 20px;
transition: all 0.2s ease;
}



.reaction-item i {
font-size: 14px;
}

.track-title {
font-size: 12px;
font-weight: 600;
color: #000;
margin-bottom: 5px;
}

.dark-style .owner-name,
.dark-style .track-title,
.dark-style .talent-text {
color: #fff !important;
}

.dark-style .owner-section {
border-bottom-color: rgba(255, 255, 255, 0.1);
}

.dark-style .upload-date-small,
.dark-style .reaction-item {
color: rgba(255, 255, 255, 0.6);
}

/* Podcast Specific Styles */
.video-icon {
position: absolute;
top: 10px;
right: 10px;
background: rgba(0, 0, 0, 0.75);
color: #ffffff;
border-radius: 50%;
padding: 6px;
font-size: 12px;
z-index: 10;
transition: background 0.2s ease;
}

.video-icon:hover {
background: rgba(0, 0, 0, 0.9);
}

.talent-details {
font-size: 10px;
margin-top: 5px;
color: #333;
}

.dark-style .talent-details {
color: rgba(255, 255, 255, 0.7) !important;
}

/* Stacked Header Styles */
.header-icon-container {
background: #851c3b;
color: #fff;
width: 40px;
height: 40px;
display: flex;
align-items: center;
justify-content: center;
border-radius: 8px;
}

.search-box-wrapper {
min-width: 250px;
}

.navbar-brand {
color: #333;
letter-spacing: 1px;
}

.dark-style .navbar-brand {
color: #fff;
}

/* Artist/Music Card Interaction Styles */
.music-card-item {
transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.music-card-item:hover {
box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
}

.play-btn-circle {
width: 50px;
height: 50px;
background: linear-gradient(135deg, #851c3b 0%, #e94560 100%);
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
color: #fff;
font-size: 18px;
box-shadow: 0 4px 15px rgba(133, 28, 59, 0.4);
transition: all 0.3s ease;
}

.play-overlay-center {
position: absolute;
top: 0;
left: 0;
right: 0;
bottom: 0;
background: rgba(0, 0, 0, 0.3);
display: flex;
align-items: center;
justify-content: center;
opacity: 0;
transition: opacity 0.3s ease;
cursor: pointer;
}

.card-img-cotainer:hover .play-overlay-center {
opacity: 1;
}

.owner-section {
display: flex;
align-items: center;
gap: 10px;
cursor: pointer;
padding: 5px;
border-radius: 8px;
transition: background 0.2s ease;
}

.owner-section:hover {
background: rgba(133, 28, 59, 0.05);
}

.dark-style .owner-section:hover {
background: rgba(255, 255, 255, 0.05);
}

.reaction-item {
cursor: pointer;
transition: all 0.2s ease;
padding: 4px 8px;
border-radius: 15px;
}



.reaction-item.active i {
color: #e94560;
}

.music-duration-badge {
position: absolute;
bottom: 8px;
right: 8px;
background: rgba(0, 0, 0, 0.7);
color: #fff;
padding: 2px 6px;
border-radius: 4px;
font-size: 10px;
}


.gallery-header {
padding: 15px 20px;
background: #1a1c24;
display: flex;
align-items: center;
gap: 15px;
border-bottom: 1px solid #434968;
}

.gallery-header h4 {
color: #fff;
margin: 0;
font-size: 18px;
}

.gallery-close-btn {
position: absolute;
top: 15px;
right: 20px;
background: rgba(255, 255, 255, 0.1);
border: none;
color: #fff;
width: 35px;
height: 35px;
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
z-index: 1051;
transition: all 0.2s;
}

.gallery-close-btn:hover {
background: rgba(255, 255, 255, 0.2);
}

.gallery-footer {
padding: 10px 20px;
background: #1a1c24;
display: flex;
justify-content: space-between;
align-items: center;
border-top: 1px solid #434968;
}

.reaction-icons {
    display: flex;
    gap: 0px;
    color: #a3a4cc;
}

.reaction-icons i {
cursor: pointer;
transition: color 0.2s;
}

.reaction-icons i:hover {
color: #fff;
}

.inline-gallery-container {
height: 70vh;
background: #000;
}

.gallery-loader {
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
z-index: 5;
text-align: center;
}

.gallery-loader.hidden {
display: none;
}

/* News Page Styles extracted from NewsPublic.php */
.mshd-news {
--primary-gradient: linear-gradient(135deg, #851c3b 0%, #e94560 100%);
--dark-bg-gradient: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
--card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
--card-hover-shadow: 0 20px 40px rgba(133, 28, 59, 0.15);
}

.mshd-news .search-filter-bar {
background: #fff;
border-radius: 12px;
padding: 8px 15px;
margin-bottom: 30px;
display: flex;
align-items: center;
justify-content: space-between;
gap: 12px;
flex-wrap: wrap;
border: 1px solid rgba(0, 0, 0, 0.08);
box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
width: 100%;
}

.dark-style .mshd-news .search-filter-bar {
background: #2b2c40;
border-color: rgba(255, 255, 255, 0.05);
box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.mshd-news .search-filter-bar .search-input {
width: 400px;
max-width: 100%;
background: #f8f9fa;
border: 1px solid #e0e0e0;
border-radius: 25px;
padding: 8px 20px;
color: #566a7f;
font-size: 14px;
transition: all 0.3s ease;
}

.dark-style .mshd-news .search-filter-bar .search-input {
background: rgba(255, 255, 255, 0.05);
border-color: rgba(255, 255, 255, 0.1);
color: #fff;
}

.mshd-news .search-filter-bar .search-input:focus {
outline: none;
border-color: #851c3b;
box-shadow: 0 0 10px rgba(133, 28, 59, 0.1);
}

.mshd-news .search-filter-bar .filter-select {
background: #fff;
border: 1px solid #d9dee3;
border-radius: 8px;
padding: 8px 15px;
color: #566a7f;
font-size: 14px;
cursor: pointer;
min-width: 140px;
}

.dark-style .mshd-news .search-filter-bar .filter-select {
background: #2b2c40;
border-color: rgba(255, 255, 255, 0.15);
color: #fff;
}

.mshd-news .section-title-premium {
font-size: 24px;
font-weight: 700;
color: var(--bs-heading-color);
margin-bottom: 25px;
display: flex;
align-items: center;
gap: 12px;
}

.mshd-news .section-title-premium i {
color: #851c3b;
font-size: 20px;
}

.mshd-news .premium-news-grid {
display: grid;
grid-template-columns: repeat(auto-fill, minmax(420px, 1fr));
gap: 35px;
margin-top: 25px;
}

.mshd-news .premium-card {
background: #fff;
border-radius: 20px;
overflow: hidden;
box-shadow: var(--card-shadow);
transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
display: flex;
flex-direction: column;
height: 100%;
border: 1px solid rgba(0, 0, 0, 0.05);
position: relative;
}

.mshd-news .premium-card:hover {
box-shadow: var(--card-hover-shadow);
}

.mshd-news .card-img-wrapper {
position: relative;
height: 280px;
overflow: hidden;
}

.mshd-news .card-img-wrapper img {
width: 100%;
height: 100%;
object-fit: cover;
transition: transform 0.8s ease;
}

.mshd-news .premium-card:hover .card-img-wrapper img {
transform: scale(1.1);
}

.mshd-news .category-badge {
position: absolute;
top: 20px;
left: 20px;
padding: 8px 22px;
background: var(--primary-gradient);
color: #fff;
border-radius: 30px;
font-size: 12px;
font-weight: 700;
text-transform: uppercase;
letter-spacing: 1px;
z-index: 5;
box-shadow: 0 5px 15px rgba(133, 28, 59, 0.3);
}

.mshd-news .premium-card-body {
padding: 30px;
flex: 1;
display: flex;
flex-direction: column;
}

.mshd-news .premium-card-title {
font-size: 26px;
font-weight: 800;
color: #1e2235;
margin-bottom: 18px;
line-height: 1.3;
display: -webkit-box;
-webkit-line-clamp: 2;
line-clamp: 2;
-webkit-box-orient: vertical;
overflow: hidden;
transition: color 0.3s;
}

.mshd-news .premium-card:hover .premium-card-title {
color: #851c3b;
}

.mshd-news .premium-card-excerpt {
font-size: 16px;
color: #666;
line-height: 1.7;
margin-bottom: 25px;
display: -webkit-box;
-webkit-line-clamp: 3;
line-clamp: 3;
-webkit-box-orient: vertical;
overflow: hidden;
}

.mshd-news .premium-card-footer {
margin-top: auto;
border-top: 1px solid rgba(0, 0, 0, 0.06);
padding-top: 20px;
display: flex;
justify-content: space-between;
align-items: center;
}

.mshd-news .meta-info {
font-size: 12px;
color: #888;
display: flex;
align-items: center;
gap: 15px;
}

.mshd-news .meta-info i {
color: #851c3b;
margin-right: 5px;
}

.mshd-news .meta-stats {
display: flex;
gap: 12px;
}

.mshd-news .stat-item {
display: flex;
align-items: center;
gap: 5px;
font-size: 13px;
color: #666;
transition: all 0.2s;
}

.mshd-news .stat-item:hover {
color: #851c3b;
}

.mshd-news .stat-item i {
font-size: 16px;
opacity: 0.7;
}


.mshd-news .loader-dots span {
width: 15px;
height: 15px;
background: var(--primary-gradient);
border-radius: 50%;
display: inline-block;
margin: 0 5px;
animation: dot-pulse 1.4s infinite ease-in-out;
}

.mshd-news .loader-dots span:nth-child(2) {
animation-delay: 0.2s;
}

.mshd-news .loader-dots span:nth-child(3) {
animation-delay: 0.4s;
}

/* Dark Mode Adjustments */
.dark-style .mshd-news .premium-card {
background: #2b2c40;
border-color: rgba(255, 255, 255, 0.05);
box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.dark-style .mshd-news .premium-card-title {
color: #fff;
}

.dark-style .mshd-news .premium-card-excerpt {
color: rgba(255, 255, 255, 0.6);
}

.dark-style .mshd-news .meta-info,
.dark-style .mshd-news .stat-item {
color: rgba(255, 255, 255, 0.5);
}

.dark-style .mshd-news .premium-card-footer {
border-top-color: rgba(255, 255, 255, 0.08);
}

@media (max-width: 768px) {
.mshd-news .premium-news-grid {
grid-template-columns: 1fr;
}
}

/* Podcasts Page Styles extracted from podcasts.php */
.mshd-podcasts .w-100 {
width: 250px !important;
height: 120px;
object-fit: fill;
}

.mshd-podcasts .space-padding {
padding-bottom: 7px;
}

.mshd-podcasts .cardbg {
background: #33374d;
border: 1px solid #434968 !important;
object-fit: contain;
}

.mshd-podcasts .cardborder {
border: 1px solid #434968 !important;
}

.mshd-podcasts .headbg {
background: #33374d;
}

.mshd-podcasts .scrolldiv {
height: 450px;
overflow-y: scroll;
}

.mshd-podcasts .cardposition {
position: absolute;
bottom: 0px;
background: #000;
opacity: 0.9;
width: 100%;
--bs-card-spacer-y: 0.3rem;
}

.mshd-podcasts .custom-dropdown {
color: #fff !important;
}

.mshd-podcasts .custom-dropdown .dropdown-item {
color: #fff !important;
}

.mshd-podcasts .custom-dropdown .dropdown-item:hover {
background-color: #44475b;
color: #fff !important;
}

.mshd-podcasts .search-box input {
color: white;
border: 1px solid #fff;
}

.mshd-podcasts .search-box input::placeholder {
color: #f8d7da;
}

.mshd-podcasts .search-box button {
border: 1px solid white;
color: white;
}

.mshd-podcasts .studio-btn {
color: white;
border: 1px solid white;
}

.mshd-podcasts .studio-btn:hover {
color: #fff;
}

.mshd-podcasts .studio-dropdown {
background-color: #e74c3c;
}

.mshd-podcasts .studio-dropdown .dropdown-item {
color: white;
}

.mshd-podcasts .studio-dropdown .dropdown-item:hover {
background-color: #c0392b;
color: #fff;
}

.mshd-podcasts .slick-next {
right: 0px !important;
}

.mshd-podcasts .slick-prev {
left: 0px !important;
}

.mshd-podcasts .slick-prev,
.mshd-podcasts .slick-next {
width: 20px;
height: 20px;
border-radius: 50%;
background: #2f3349bd !important;
color: #ffffff;
font-size: 12px;
padding: 0;
cursor: pointer;
display: flex !important;
align-items: center;
justify-content: center;
transition: all 0.3s ease;
z-index: 10;
border: none;
}

.mshd-podcasts .slick-prev:before,
.mshd-podcasts .slick-next:before {
font-family: 'FontAwesome';
font-size: 9px;
color: #ffffff;
line-height: 1;
}

.mshd-podcasts .slick-prev:before {
content: '\f053';
}

.mshd-podcasts .slick-next:before {
content: '\f054';
}

.mshd-podcasts .top-bar .d-flex.align-items-center {
gap: 12px;
}

.mshd-podcasts .carousel-control-prev-icon,
.mshd-podcasts .carousel-control-next-icon {
display: none;
}

.mshd-podcasts .slider-container {
width: 100%;
}

.mshd-podcasts .ad-box {
width: 13%;
background-color: #2a2f3a;
color: white;
text-align: center;
line-height: 400px;
float: right;
}

.mshd-podcasts .slider .slick-slide:last-child .card1 {
margin-right: 0;
}

.mshd-podcasts .lost-found-slider .slick-slide {
padding: 0 10px;
box-sizing: border-box;
}

.mshd-podcasts .lost-found-slider .card {
margin: 0 auto;
height: 100%;
}

.mshd-podcasts #lost_found_slider img.img-fluid.rounded-3.mb-3 {
height: 237px;
object-fit: contain;
}

.mshd-podcasts .ad {
background: #fff;
color: #000;
padding: 20px;
border: 1px solid #ccc;
height: 316px;
box-sizing: border-box;
}

.mshd-podcasts .card.profile-card {
border: 1px solid #fff;
border-radius: 8px;
}

.mshd-podcasts #new-cards .card {
border: 1px solid #ffffff !important;
}

.mshd-podcasts .card-img-cotainer {
height: 210px;
overflow: hidden;
}

.mshd-podcasts .card-img-cotainer img {
height: 100%;
width: 100%;
object-fit: cover;
object-position: top;
}

.mshd-podcasts .card-text {
font-size: 12px;
}

.mshd-podcasts .models-slider .waves-light {
font-size: 12px;
padding: 3px 6px;
}

.mshd-podcasts .card-body {
font-size: 12px;
padding: 15px;
padding-bottom: 0px;
background-color: #fff;
}

.mshd-podcasts .card-body .talent-text {
margin: 0 !important;
}

.mshd-podcasts img.card-logo {
height: 40px;
}

.mshd-podcasts .thumbnails {
position: absolute;
top: 6%;
right: 11px;
overflow: hidden;
}

.mshd-podcasts .card-image {
position: relative;
}

.mshd-podcasts .mainImage-img {
height: 100%;
width: 100%;
}

.mshd-podcasts .header-text {
line-height: 15px;
color: #000000ff;
}

.mshd-podcasts .brand-name {
font-size: 15px;
}

.mshd-podcasts .talent-text {
font-size: 10px;
margin-top: 10px;
color: #000000ff;
}

.mshd-podcasts .post-date {
font-size: 10px;
color: #000000ff;
}

.mshd-podcasts .agency-contact-group {
display: flex;
align-items: center;
justify-content: space-between;
font-size: 12px;
margin-bottom: 10px;
color: #000000ff;
}

.mshd-podcasts .card-content {
padding: 15px;
background-color: #fff;
}

.mshd-podcasts .card-footer-custom {
padding: 20px;
background-color: #fff;
}

.mshd-podcasts img.thumbnail-img {
height: 30px;
width: 37px;
object-fit: cover;
object-position: top;
margin-bottom: 10px;
border-radius: 6px;
}

.mshd-podcasts .footer-stats {
display: flex;
align-items: center;
justify-content: space-between;
font-size: 12px;
color: #000000ff;
}

.mshd-podcasts .footer-stats i {
font-size: 12px;
}

.mshd-podcasts small.talent-summary {
font-size: 10px;
}

.mshd-podcasts .media-count.text-end.mt-2.pe-2 {
position: absolute;
top: 81%;
right: 0;
color: #ffffff;
line-height: 9px;
padding: 5px;
background: rgba(0, 0, 0, 0.75);
}

.mshd-podcasts small.media-stats {
font-weight: 900;
color: #ffffff;
font-size: 8px;
}

.mshd-podcasts .card1 .card {
box-shadow: 0 0 2px 0 rgb(0 0 0 / 22%) !important;
overflow: hidden;
}

.mshd-podcasts nav.navbar {
box-shadow: 0 0 2px 0 rgb(0 0 0 / 22%) !important;
border-radius: 12px;
}

.mshd-podcasts .form-control {
display: block;
width: 100%;
padding: 0.422rem 0.875rem;
font-size: 13px;
font-weight: 400;
line-height: 1.5;
height: 31px;
color: #6f6b7d;
background-color: #fff;
background-clip: padding-box;
border: 1px solid #dbdade;
appearance: none;
border-radius: 25px;
transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.mshd-podcasts button.follow-btn {
position: absolute;
top: 9px;
right: 15px;
}

/* Video Page Styles extracted from videos_public.php */
.mshd-videos .video-card-wrapper {
display: flex;
}

.mshd-videos .card1 {
margin-bottom: 20px;
width: 100%;
display: flex;
}

.mshd-videos .card1 .card {
box-shadow: 0 0 2px 0 rgb(0 0 0 / 22%) !important;
overflow: hidden;
width: 100%;
}

.mshd-videos .card1 .card-body {
flex: 1;
display: flex;
flex-direction: column;
}

.mshd-videos .card-content {
padding: 15px;
background-color: #fff;
position: relative;
}

.mshd-videos .track-icon {
width: 40px;
height: 40px;
background: linear-gradient(135deg, #851c3b 0%, #e94560 100%);
border-radius: 10px;
display: flex;
align-items: center;
justify-content: center;
color: #fff;
font-size: 16px;
}

.mshd-videos .card-img-cotainer {
height: 220px;
overflow: hidden;
position: relative;
border-radius: 12px 12px 0 0;
}

.mshd-videos .card-img-cotainer img {
height: 100%;
width: 100%;
object-fit: cover;
object-position: top;
}

.mshd-videos button.follow-btn {
outline: none !important;
border: 1px solid #000000ff;
font-size: 12px;
background: #000;
color: #ffffffff;
border-radius: 25px;
display: flex;
align-items: center;
padding: 2px 8px;
}

.mshd-videos .card-body {
font-size: 12px;
padding: 15px 15px 0 15px;
background-color: #fff;
}

.mshd-videos .card-footer-custom {
padding: 15px;
background-color: #fff;
}

.mshd-videos .owner-section {
display: flex;
align-items: center;
gap: 10px;
padding-bottom: 12px;
margin-bottom: 12px;
border-bottom: 1px solid rgba(0, 0, 0, 0.1);
cursor: pointer;
}

.mshd-videos .owner-avatar {
width: 40px;
height: 40px;
border-radius: 50%;
object-fit: cover;
border: 2px solid #851c3b;
}

.mshd-videos .owner-info {
display: flex;
flex-direction: column;
}

.mshd-videos .owner-name {
font-size: 13px;
font-weight: 600;
color: #333;
}

.mshd-videos .upload-date-small {
font-size: 10px;
color: #6c757d;
}

.mshd-videos .reaction-footer {
display: flex;
align-items: center;
justify-content: space-between;
gap: 8px;
}

.mshd-videos .reaction-item {
display: flex;
align-items: center;
gap: 5px;
font-size: 12px;
color: #666;
cursor: pointer;
padding: 5px 8px;
border-radius: 20px;
}



.mshd-videos .play-overlay-center {
position: absolute;
top: 0;
left: 0;
right: 0;
bottom: 0;
background: rgba(0, 0, 0, 0.4);
display: flex;
align-items: center;
justify-content: center;
transition: opacity 0.3s ease;
cursor: pointer;
}

.mshd-videos .play-btn-circle {
width: 60px;
height: 60px;
background: linear-gradient(135deg, #851c3b 0%, #e94560 100%);
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
color: #fff;
font-size: 22px;
box-shadow: 0 5px 20px rgba(133, 28, 59, 0.5);
transition: transform 0.3s ease;
}

.mshd-videos .play-btn-circle:hover {
transform: scale(1.1);
}

.mshd-videos .music-duration-badge {
position: absolute;
bottom: 10px;
right: 10px;
background: rgba(0, 0, 0, 0.8);
color: #fff;
padding: 3px 8px;
border-radius: 4px;
font-size: 11px;
font-weight: 500;
}

.mshd-videos .talent-text {
font-size: 10px;
margin-top: 5px;
color: #000;
display: -webkit-box;
-webkit-box-orient: vertical;
-webkit-line-clamp: 2;
line-clamp: 2;
overflow: hidden;
text-overflow: ellipsis;
}

.mshd-videos .track-title {
font-size: 12px;
font-weight: 600;
color: #000;
margin-bottom: 5px;
}

.mshd-videos .video-card {
background: linear-gradient(145deg, #2a2f3a 0%, #1e2235 100%);
border-radius: 16px;
overflow: hidden;
box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
transition: transform 0.3s ease, box-shadow 0.3s ease;
height: 100%;
border: 1px solid rgba(255, 255, 255, 0.05);
display: flex;
flex-direction: column;
}

.mshd-videos .video-card:hover {
transform: translateY(-8px);
box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

.mshd-videos .video-thumbnail {
position: relative;
height: 280px;
overflow: hidden;
}

.mshd-videos .video-thumbnail img {
width: 100%;
height: 100%;
object-fit: cover;
transition: transform 0.5s ease;
}

.mshd-videos .video-card:hover .video-thumbnail img {
transform: scale(1.1);
}

.mshd-videos .video-duration {
position: absolute;
bottom: 10px;
right: 10px;
background: rgba(0, 0, 0, 0.8);
color: #fff;
padding: 2px 8px;
border-radius: 4px;
font-size: 11px;
font-weight: 500;
}

.mshd-videos .no-thumbnail-placeholder {
width: 100%;
height: 100%;
background: linear-gradient(135deg, #2a2f3a 0%, #1e2235 100%);
display: flex;
align-items: center;
justify-content: center;
text-align: center;
padding: 20px;
font-size: 16px;
font-weight: 600;
color: rgba(255, 255, 255, 0.7);
border-radius: 12px 12px 0 0;
}

.mshd-videos .video-genre-badge {
position: absolute;
top: 15px;
left: 15px;
background: linear-gradient(135deg, #851c3b 0%, #e94560 100%);
color: #fff;
padding: 4px 10px;
border-radius: 12px;
font-size: 10px;
font-weight: 600;
text-transform: uppercase;
letter-spacing: 0.5px;
z-index: 10;
}

.mshd-videos .talent-summary {
font-size: 10px;
color: rgba(255, 255, 255, 0.6);
}

.mshd-videos .video-description {
font-size: 11px;
color: rgba(255, 255, 255, 0.5);
margin-top: 10px;
display: -webkit-box;
-webkit-line-clamp: 2;
line-clamp: 2;
-webkit-box-orient: vertical;
overflow: hidden;
line-height: 1.4;
}

.mshd-videos .search-filter-bar {
display: flex;
gap: 15px;
margin-bottom: 30px;
background: rgba(255, 255, 255, 0.05);
padding: 20px;
border-radius: 15px;
border: 1px solid rgba(255, 255, 255, 0.1);
flex-wrap: wrap;
}

.mshd-videos .search-input {
flex: 1;
min-width: 250px;
background: rgba(255, 255, 255, 0.1);
border: 1px solid rgba(255, 255, 255, 0.1);
border-radius: 10px;
padding: 10px 20px;
color: #fff;
outline: none;
transition: all 0.3s ease;
}

.mshd-videos .search-input:focus {
border-color: #851c3b;
box-shadow: 0 0 10px rgba(133, 28, 59, 0.3);
}

.mshd-videos .filter-select {
background: rgba(255, 255, 255, 0.1);
border: 1px solid rgba(255, 255, 255, 0.1);
border-radius: 10px;
padding: 10px 15px;
color: #fff;
outline: none;
cursor: pointer;
min-width: 150px;
}

.mshd-videos .filter-select option {
background: #1e2235;
color: #fff;
}

.mshd-videos .watch-btn {
background: linear-gradient(135deg, #851c3b 0%, #e94560 100%);
border: none;
color: #fff;
padding: 6px 15px;
border-radius: 20px;
display: flex;
align-items: center;
gap: 8px;
font-weight: 600;
transition: all 0.3s ease;
box-shadow: 0 4px 15px rgba(133, 28, 59, 0.3);
}

.mshd-videos .watch-btn:hover {
transform: scale(1.05);
box-shadow: 0 6px 20px rgba(133, 28, 59, 0.5);
}

.mshd-videos .section-title {
color: #fff;
font-size: 22px;
font-weight: 600;
margin-bottom: 25px;
display: flex;
align-items: center;
gap: 12px;
}

.mshd-videos .section-title i {
color: #851c3b;
font-size: 20px;
}


.mshd-videos .bouncing-loader {
display: flex;
gap: 10px;
}

.mshd-videos .bouncing-loader div {
width: 15px;
height: 15px;
background: #851c3b;
border-radius: 50%;
animation: bounce 0.6s infinite alternate;
}

.mshd-videos .bouncing-loader div:nth-child(2) {
animation-delay: 0.2s;
}

.mshd-videos .bouncing-loader div:nth-child(3) {
animation-delay: 0.4s;
}

@keyframes bounce {
from {
transform: translateY(0);
}

to {
transform: translateY(-15px);
}
}

.mshd-videos .premium-bg {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
z-index: -1;
background: linear-gradient(rgba(30, 34, 53, 0.8), rgba(30, 34, 53, 0.8)), url('/artist-bg.png') no-repeat center center/cover;
pointer-events: none;
}

/* Light theme overrides */
.light-style .mshd-videos .video-card {
background: #fff;
border: 1px solid #e0e0e0;
}

.light-style .mshd-videos .video-card .card-body,
.light-style .mshd-videos .video-card .card-content,
.light-style .mshd-videos .video-card .card-footer-custom {
background: #fff;
}

.light-style .mshd-videos .video-title,
.light-style .mshd-videos .owner-name,
.light-style .mshd-videos .section-title {
color: #333;
}

.light-style .mshd-videos .talent-summary,
.light-style .mshd-videos .video-description,
.light-style .mshd-videos .upload-date-small,
.light-style .mshd-videos .reaction-item {
color: #666;
}

.light-style .mshd-videos .search-filter-bar {
background: #f5f5f5;
border-color: #e0e0e0;
}

.light-style .mshd-videos .search-filter-bar .search-input,
.light-style .mshd-videos .search-filter-bar .filter-select {
background: #fff;
border-color: #ddd;
color: #333;
}

.light-style .mshd-videos .no-thumbnail-placeholder {
background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
color: #666;
}

.light-style .mshd-videos .premium-bg {
background: linear-gradient(rgba(244, 245, 250, 0.9), rgba(244, 245, 250, 0.9)), url('/artist-bg.png') no-repeat center center/cover;
}

/* Artist Page Specific Styles */
.mshd-artists .artist-img {
height: 250px;
object-fit: cover;
border-radius: 8px;
}

.mshd-artists .claim-btn {
position: absolute;
top: 9px;
right: 15px;
outline: none;
border: 1px solid #515151;
font-size: 12px;
background: transparent;
color: #515151;
border-radius: 25px;
padding: 2px 10px;
}

.mshd-artists .claim-btn.active {
border-color: green;
color: green;
}

.mshd-artists .search-box {
position: relative;
}

.mshd-artists .search-container input.form-control {
padding-right: 2.5rem;
height: 31px;
font-size: 13px;
border-radius: 25px;
}

.mshd-artists .filter-container {
position: relative;
width: 200px;
margin-left: 10px;
}

.mshd-artists .filter-container select.form-control {
height: 31px;
font-size: 13px;
border-radius: 25px;
}

.mshd-artists .card-grid-wrapper {
margin-top: 20px;
}

/* Single News Article Styles */
.mshd-single-news .news-hero {
position: relative;
border-radius: 4px;
overflow: hidden;
margin-bottom: 24px;
box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
border: 2px solid #cacaca;
}

.mshd-single-news .news-hero-image {
width: 100%;
height: 400px;
object-fit: cover;
display: block;
}

.mshd-single-news .news-hero-overlay {
position: absolute;
bottom: 0;
left: 0;
right: 0;
background: linear-gradient(transparent, rgba(0, 0, 0, 0.85));
padding: 60px 30px 30px;
}

.mshd-single-news .news-hero-category {
position: absolute;
top: 20px;
left: 20px;
z-index: 20;
background: #7c1835 !important;
color: #ffffff !important;
padding: 6px 15px;
border-radius: 4px;
font-size: 13px;
font-weight: 700;
text-transform: uppercase;
}

.mshd-single-news .news-hero-title {
font-size: 24px;
font-weight: 700;
color: #fff;
line-height: 1.3;
margin: 0;
}

.mshd-single-news .article-content {
font-size: 14px;
line-height: 1.85;
}

.mshd-single-news .thumbnail-gallery {
display: flex;
gap: 12px;
padding: 20px 0;
flex-wrap: wrap;
}

.mshd-single-news .thumbnail-item {
width: 120px;
height: 90px;
border-radius: 4px;
overflow: hidden;
cursor: pointer;
border: 2px solid #cacaca;
}

.mshd-single-news .thumbnail-item img {
width: 100%;
height: 100%;
object-fit: cover;
}

/* --- Home Page Premium Redesign Styles --- */

.hero-premium-card {
background: rgba(255, 255, 255, 0.03);
backdrop-filter: blur(10px);
-webkit-backdrop-filter: blur(10px);
border: 1px solid rgba(255, 255, 255, 0.1);
border-radius: 20px;
overflow: hidden;
box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
transition: transform 0.3s ease;
}

.dark-style .hero-premium-card {
background: rgba(0, 0, 0, 0.2);
}

.live-player-container {
position: relative;
background: #000;
border-radius: 16px 16px 0 0;
overflow: hidden;
}

.live-badge-premium {
position: absolute;
top: 20px;
left: 20px;
background: rgba(133, 28, 59, 0.9);
color: #fff;
padding: 5px 15px;
border-radius: 50px;
font-size: 11px;
font-weight: 700;
text-transform: uppercase;
letter-spacing: 1px;
display: flex;
align-items: center;
gap: 8px;
z-index: 10;
box-shadow: 0 0 15px rgba(133, 28, 59, 0.5);
animation: glow-pulse 2s infinite;
}

@keyframes glow-pulse {
0% {
box-shadow: 0 0 10px rgba(133, 28, 59, 0.5);
}

50% {
box-shadow: 0 0 25px rgba(133, 28, 59, 0.8), 0 0 40px rgba(133, 28, 59, 0.4);
}

100% {
box-shadow: 0 0 10px rgba(133, 28, 59, 0.5);
}
}

.live-badge-premium::before {
content: '';
width: 8px;
height: 8px;
background: #fff;
border-radius: 50%;
display: block;
}

.hero-meta-section {
padding: 25px;
background: linear-gradient(180deg, rgba(133, 28, 59, 0.1) 0%, rgba(26, 29, 33, 0.8) 100%);
border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.dark-style .hero-meta-section {
background: linear-gradient(180deg, rgba(133, 28, 59, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%);
}

.meta-status-label {
font-size: 11px;
text-transform: uppercase;
letter-spacing: 1.5px;
color: rgba(255, 255, 255, 0.5);
font-weight: 600;
margin-bottom: 5px;
}

.meta-title-premium {
color: #fff;
font-weight: 700;
font-size: 1.4rem;
margin-bottom: 12px;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.meta-progress {
height: 6px !important;
background: rgba(255, 255, 255, 0.1) !important;
border-radius: 10px;
overflow: hidden;
}

.meta-progress .progress-bar {
background: var(--mshd-maroon-gradient) !important;
box-shadow: 0 0 15px rgba(133, 28, 59, 0.6);
}

/* Tab Redesign */
.nav-tabs-premium {
border-bottom: none !important;
gap: 10px;
padding: 10px;
}

.nav-tabs-premium .nav-item .nav-link {
border: none !important;
border-radius: 12px !important;
color: rgba(255, 255, 255, 0.6) !important;
font-weight: 600;
font-size: 13px;
padding: 10px 20px;
transition: all 0.3s ease;
background: rgba(255, 255, 255, 0.05);
}

.nav-tabs-premium .nav-item .nav-link.active {
background: var(--mshd-maroon) !important;
color: #fff !important;
box-shadow: 0 5px 15px rgba(133, 28, 59, 0.3);
}

.nav-tabs-premium .nav-item .nav-link:hover:not(.active) {
background: rgba(255, 255, 255, 0.1);
color: #fff !important;
}

/* Card Improvements */
.mshd-card-premium {
background: rgba(255, 255, 255, 0.05);
backdrop-filter: blur(5px);
border-radius: 16px;
border: 1px solid rgba(255, 255, 255, 0.1);
transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.mshd-card-premium:hover {
transform: translateY(-8px);
background: rgba(133, 28, 59, 0.1);
border-color: rgba(133, 28, 59, 0.3);
box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
}

/* Glassmorphism sidebar */
.media-list-glass {
background: rgba(255, 255, 255, 0.03) !important;
backdrop-filter: blur(15px);
-webkit-backdrop-filter: blur(15px);
border: 1px solid rgba(255, 255, 255, 0.05) !important;
}

.search-box-premium {
background: rgba(255, 255, 255, 0.05);
border: 1px solid rgba(255, 255, 255, 0.1);
border-radius: 12px;
padding: 8px 15px;
display: flex;
align-items: center;
gap: 10px;
}

.search-box-premium input {
background: transparent;
border: none;
color: #fff;
font-size: 14px;
width: 100%;
}

.search-box-premium input:focus {
outline: none;
}

.search-box-premium i {
color: rgba(255, 255, 255, 0.5);
}

/* Sub-header premium styles */
.navbar-sub-header .navbar-brand {
color: #2c323f !important;
transition: color 0.3s ease;
}

.dark-style .navbar-sub-header .navbar-brand {
color: #fff !important;
}

.navbar-sub-header .nav-container {
transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.navbar-sub-header .nav-container:hover {
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3) !important;
}

/* Event / Music / News Card Dark Mode Visibility Improvements */
.dark-style .card .card-title,
.dark-style .event-card .card-title {
color: #fff !important;
}



.dark-style .card .card-text,
.dark-style .event-card .card-text {
color: rgba(255, 255, 255, 0.9) !important;
}

/* Specific fix for "blurry" category text / small labels */
.dark-style .card small.text-muted.text-uppercase,
.dark-style .event-card small.text-muted.text-uppercase {
color: #fff !important;
opacity: 1;
font-weight: 600;
text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
/* Prevents "blur" on some displays */
}

.dark-style .cardposition-overlay small,
.dark-style .event-card .cardposition-overlay small {
color: #fff !important;
}

.dark-style .bg-label-secondary {
background-color: rgba(255, 255, 255, 0.1) !important;
color: #fff !important;
}

.dark-style .bg-label-secondary i {
color: #fff !important;
}


.dark-style .card-header small {
color: rgba(255, 255, 255, 0.8) !important;
}



.dark-style .sub-header-icon {
color: #fff !important;
}


.dark-style .text-maroon {
color: #fff !important;
}

/* Custom Maroon Label */
.bg-maroon {
    background-color: #851c1c99 !important;
    color:#fff!important;
}

.bg-maroon i {
color: #fff !important;
}





/* Specific Card Icon Refinements */
.event-card .card-footer .ti-heart-filled {
color: var(--mshd-maroon) !important;
display: inline-block !important;
}

.event-card .card-footer .ti-heart {
color: #566a7f !important;
display: inline-block !important;
}

/* Default Interaction Icons in Cards */
.event-card .card-footer .ti {
color: #566a7f;
transition: all 0.3s ease;
font-size: 1.25rem !important;
}


.event-card .card-text.text-muted,
.event-card .card-header small,
.event-card .card-footer small.fw-bold {
color: #566a7f !important;
opacity: 1;
}

.dark-style .event-card .card-footer .ti:not(.ti-heart-filled) {
color: rgba(255, 255, 255, 0.8) !important;
}

.dark-style .event-card .card-title,
.dark-style .event-card .card-text.text-muted {
color: #fff !important;
}

.bg-label-maroon {
background-color: inherit !important;
color: var(--mshd-maroon) !important;
}



/* Main Logo Dark Mode Adjustment */
.dark-style .app-brand-link img {
filter: none !important;
}

/* lightGallery Z-Index Fix to cover Navbar */
.lg-backdrop {
z-index: 20000 !important;
}

.lg-outer {
z-index: 20001 !important;
}

/* Custom Gallery Header */
.lg-custom-header {
position: absolute;
top: 0;
left: 0;
width: 100%;
padding: 8px 20px;
background: rgba(0, 0, 0, 0.5);
z-index: 100000;
display: flex;
align-items: center;
gap: 10px;
pointer-events: none;
flex-wrap: nowrap;
}

.lg-custom-header>* {
pointer-events: auto;
flex-shrink: 0;
}

.lg-header-logo {
width: 40px;
height: 40px;
background: url('/images/mshdlogo.fw.png') no-repeat center;
background-size: contain;
flex-shrink: 0;
}

.lg-header-title {
color: #fff;
margin: 0;
font-size: 1.1rem;
font-weight: 600;
text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6);
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
flex-shrink: 1;
min-width: 0;
}

/* Counter - simple white text next to logo */
.lg-counter {
color: rgba(255, 255, 255, 0.85) !important;
font-weight: 500 !important;
font-size: 14px !important;
line-height: 1 !important;
padding: 0 !important;
background: none !important;
border-radius: 0 !important;
margin-left: 0 !important;
display: inline !important;
}

.lg-toolbar {
background: rgba(0, 0, 0, 0.45) !important;
height: 50px !important;
padding: 0 10px !important;
}

@media (max-width: 768px) {
.lg-custom-header {
padding: 8px 12px;
}

.lg-header-logo {
width: 30px;
height: 30px;
}

.lg-header-title {
font-size: 0.9rem;
max-width: 120px;
}
}

/* Shift image down for toolbar clearance */
.lg-outer .lg-item {
padding-top: 50px !important;
padding-bottom: 0 !important;
}

/* Make fullscreen gallery look like contained inline box */
.lg-container {
z-index: 99999 !important;
}

.lg-backdrop {
background-color: rgba(0, 0, 0, 0.95) !important;
}

.lg-toolbar {
background: rgba(0, 0, 0, 0.45) !important;
height: 50px !important;
padding: 0 10px !important;
}

.lg-toolbar .lg-icon {
color: rgba(255, 255, 255, 0.8) !important;
font-size: 22px !important;
}

.lg-toolbar .lg-icon:hover {
color: #fff !important;
}

.lg-prev,
.lg-next {
color: rgba(255, 255, 255, 0.6) !important;
font-size: 28px !important;
}

.lg-prev:hover,
.lg-next:hover {
color: #fff !important;
}

.lg-thumb-outer {
background: rgba(0, 0, 0, 0.75) !important;
}

/* Inline Gallery Container Styles */
#inline-gallery-container {
background: #000;
}

#inline-gallery-container .lg-outer {
position: relative !important;
width: 100% !important;
height: 100% !important;
}

#inline-gallery-container .lg-backdrop {
background: transparent !important;
}

#inline-gallery-container .lg-toolbar {
background: rgba(0, 0, 0, 0.45) !important;
height: auto !important;
padding: 8px 10px;
}

#inline-gallery-container .lg-counter {
color: #fff !important;
font-size: 14px !important;
font-weight: 600 !important;
position: absolute;
top: 12px;
left: 15px;
z-index: 1090;
background: rgba(133, 28, 59, 0.85);
padding: 3px 10px;
border-radius: 5px;
line-height: normal !important;
margin-left: 0 !important;
}

#inline-gallery-container .lg-item {
padding-top: 0 !important;
padding-bottom: 0 !important;
}

#inline-gallery-close:hover {
opacity: 1;
transform: scale(1.2);
transition: all 0.2s ease;
}

/* Sub-header Search Bar Refinements */

.navbar-sub-header .search-event {
background: transparent !important;
color: inherit !important;
border: none !important;
border-left: 0 !important;
}

.navbar-sub-header .input-group-text {
background: transparent !important;
border: none !important;
padding-right: 0 !important;
}

.navbar-sub-header .search-event::placeholder {
color: #6f6b7d !important;
opacity: 0.6;
}

.navbar-sub-header .input-group-merge {
border: 1px solid #dbdade !important;
background-color: #fff !important;
}

.dark-style .navbar-sub-header .input-group-merge {
background-color: transparent !important;
border-color: rgba(255, 255, 255, 0.2) !important;
}



.dark-style .bg-label-maroon {
background-color: inherit !important;
color: #fff !important;
}

.sub-header-icon {
    color: #2c323f !important;
    transition: color 0.3s ease;
    position: relative;
    top: -1px;
    font-size: 22px !important;
    left: 1px;
}


.bg-label-secondary {
background: #f2f2f3 !important;
}

.search-container input.form-control {
padding-right: 2.5rem;
/* Space for the icon */
height: 31px;
font-size: 13px;
color: #6f6b7d;
background-color: #fff;
border: 1px solid #dbdade !important;
border-radius: 25px;
}

/* Ensure dropdown options have solid background */


.search-container input.form-control:focus {
border-color: #851c3b;
box-shadow: none;
}

.search-container .search-icon,
.search-container .clear-icon {
position: absolute;
right: 10px;
top: 50%;
transform: translateY(-50%);
font-size: 14px;
color: #eecfd2 !important;
cursor: pointer;
transition: color 0.2s ease;
}

.form-select option {
background-color: #fff;
color: #2c323f;
}

.dark-style .bg-menu-theme .menu-link,
.bg-menu-theme .menu-horizontal-prev,
.bg-menu-theme .menu-horizontal-next {
color: #fff;
}

.mshd-homepage .card-body {
font-size: 12px;
padding: 15px;
padding-bottom: 0px;

}

.mshd-homepage .card-body {
font-size: 12px;
padding: 15px;
}

/* Coming Soon Page Styles - Global */
body.coming-soon-body {
height: 100vh;
overflow: hidden;
font-family: 'Public Sans', sans-serif;
display: flex;
justify-content: center;
align-items: center;
background: linear-gradient(-45deg, #0f111a, #1e2235, #851c3b, #2a2f4a);
background-size: 400% 400%;
animation: gradientMoveComing 12s ease infinite;
position: relative;
color: #fff;
text-align: center;
}

@keyframes gradientMoveComing {
0% {
background-position: 0% 50%;
}

50% {
background-position: 100% 50%;
}

100% {
background-position: 0% 50%;
}
}

body.coming-soon-body::before {
content: '';
position: absolute;
width: 200%;
height: 200%;
background: radial-gradient(circle at center, rgba(255, 77, 109, 0.3), transparent 60%);
animation: rotateLightComing 20s linear infinite;
}

@keyframes rotateLightComing {
from {
transform: rotate(0deg);
}

to {
transform: rotate(360deg);
}
}

.coming-soon-page .coming-text {
font-size: 5rem;
font-weight: 900;
letter-spacing: 10px;
text-transform: uppercase;
perspective: 1000px;
animation: glowPulseComing 3s ease-in-out infinite alternate;
}

.coming-soon-page .coming-text span {
display: inline-block;
opacity: 0;
transform: translateY(80px) rotateX(90deg);
background: linear-gradient(45deg, #ffffff, #ff4d6d, #ffffff);
-webkit-background-clip: text;
background-clip: text;
-webkit-text-fill-color: transparent;
animation: letterRevealComing 0.8s forwards;
}

.coming-soon-page .coming-text span:nth-child(1) {
animation-delay: 0.1s;
}

.coming-soon-page .coming-text span:nth-child(2) {
animation-delay: 0.2s;
}

.coming-soon-page .coming-text span:nth-child(3) {
animation-delay: 0.3s;
}

.coming-soon-page .coming-text span:nth-child(4) {
animation-delay: 0.4s;
}

.coming-soon-page .coming-text span:nth-child(5) {
animation-delay: 0.5s;
}

.coming-soon-page .coming-text span:nth-child(6) {
animation-delay: 0.6s;
}

.coming-soon-page .coming-text span:nth-child(7) {
animation-delay: 0.7s;
}

.coming-soon-page .coming-text span:nth-child(8) {
animation-delay: 0.8s;
}

.coming-soon-page .coming-text span:nth-child(9) {
animation-delay: 0.9s;
}

.coming-soon-page .coming-text span:nth-child(10) {
animation-delay: 1s;
}

.coming-soon-page .coming-text span:nth-child(11) {
animation-delay: 1.1s;
}

@keyframes letterRevealComing {
0% {
opacity: 0;
transform: translateY(80px) rotateX(90deg);
}

100% {
opacity: 1;
transform: translateY(0) rotateX(0deg);
}
}

@keyframes glowPulseComing {
from {
text-shadow: 0 0 10px rgba(255, 77, 109, 0.3), 0 0 20px rgba(255, 77, 109, 0.2);
}

to {
text-shadow: 0 0 25px rgba(255, 77, 109, 0.8), 0 0 50px rgba(255, 77, 109, 0.6);
}
}

.coming-soon-page .subtitle {
font-size: 1.3rem;
margin-top: 20px;
opacity: 0.85;
}

.coming-soon-page .loader {
margin: 40px auto;
width: 80px;
height: 80px;
border-radius: 50%;
border: 5px solid rgba(255, 255, 255, 0.2);
border-top: 5px solid #ff4d6d;
animation: spinComingPage 1s linear infinite;
}

@keyframes spinComingPage {
100% {
transform: rotate(360deg);
}
}

.coming-soon-page .btn-back {
display: inline-block;
margin-top: 20px;
padding: 14px 45px;
border-radius: 50px;
background: linear-gradient(45deg, #851c3b, #ff4d6d);
color: #fff;
font-weight: 600;
text-decoration: none;
transition: 0.3s;
}

.coming-soon-page .btn-back:hover {
transform: translateY(-5px);
box-shadow: 0 10px 30px rgba(255, 77, 109, 0.6);
color: #fff;
}

.coming-soon-page .particle {
position: absolute;
width: 5px;
height: 5px;
background: #fff;
border-radius: 50%;
opacity: 0.6;
animation: floatUpComingPage linear infinite;
z-index: 1;
}

@keyframes floatUpComingPage {
from {
transform: translateY(100vh);
}

to {
transform: translateY(-10vh);
}
}

@media(max-width: 768px) {
.coming-soon-page .coming-text {
font-size: 2.5rem;
}
}

/* =========================================================================
JOBS PAGE STYLES
========================================================================= */
.jobs-page .navbar-brand {
letter-spacing: 1px;
}

.jobs-page .search-box {
max-width: 250px;
}

.jobs-page .search-box .input-group {
width: 250px;
}

.jobs-page .search-box .form-control {
box-shadow: none !important;
}

.jobs-page .filter-select {
min-width: 140px;
}

.jobs-page .job-title-link {
letter-spacing: -0.5px;
}

.jobs-page .job-type-label {
font-size: 10px;
letter-spacing: 0.5px;
}

.jobs-page .date-label {
font-size: 10px;
font-weight: 600;
}

.jobs-page .job-card-image {
height: 220px;
}

.jobs-page .apply-btn {
font-size: 11px;
font-weight: 600;
}

.jobs-page .badge-sm {
padding: 2px 8px;
font-size: 10px;
}

.jobs-page .overlay-controls {
z-index: 10;
}

/* =========================================================================
FEEDS PAGE STYLES
========================================================================= */

.feeds-page .hero-lead {
max-width: 800px;
}

.feeds-page .navbar-brand {
letter-spacing: 1px;
}

.feeds-page .search-box {
max-width: 250px;
}

.feeds-page .search-box .input-group {
width: 250px;
}

.feeds-page .search-box .form-control {
box-shadow: none !important;
}

.feeds-page .filter-select {
min-width: 140px;
}

.feeds-page .feed-card-image {
height: 220px;
object-fit: cover;
}

.feeds-page .avatar-feed {
width: 40px;
height: 40px;
display: flex;
justify-content: center;
}

.feeds-page .feed-title-link {
letter-spacing: -0.5px;
}

.feeds-page .feed-type-label {
font-size: 10px;
letter-spacing: 0.5px;
}

.feeds-page .feed-meta-cat {
max-width: 50%;
}

.feeds-page .feed-meta-stat {
max-width: 45%;
}

.feeds-page .overlay-controls {
z-index: 10;
}

/* =========================================================================
SHOP PAGE STYLES
========================================================================= */
.shop-page .avatar-shop {
width: 40px;
height: 40px;
display: flex;
align-items: center;
justify-content: center;
}

.shop-page .shop-title-link {
letter-spacing: -0.5px;
}

.shop-page .shop-cat-label {
font-size: 10px;
letter-spacing: 0.5px;
}

.shop-page .shop-meta-price {
background: rgba(133, 28, 59, 0.9);
padding: 4px 12px;
border-radius: 50px;
font-weight: 700;
}

.shop-page .product-image {
height: 250px;
object-fit: cover;
}

.shop-page .add-to-cart-overlay {
background: var(--maroon-primary, #851c3b);
color: white;
padding: 6px 16px;
font-weight: 600;
transition: all 0.3s ease;
font-size: 13px;
}

.shop-page .add-to-cart-overlay:hover {
background: #6d1630;
transform: scale(1.05);
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.shop-page .cta-section {
background: rgba(133, 28, 59, 0.1);
backdrop-filter: blur(10px);
border: 1px solid rgba(133, 28, 59, 0.2);
}

/* =========================================================================
POLICIES PAGE STYLES
========================================================================= */
.policies-page .avatar-policy {
width: 40px;
height: 40px;
display: flex;
align-items: center;
justify-content: center;
}

.policies-page .policy-title-link {
letter-spacing: -0.5px;
}

.policies-page .policy-update-label {
font-size: 10px;
letter-spacing: 0.5px;
}

.policies-page .policy-content {
line-height: 1.7;
}

.policies-page .policy-card-footer {
background: transparent !important;
}

/* =========================================================================
ADVERTISE PAGE STYLES
========================================================================= */
.advertise-page .avatar-advertise {
width: 40px;
height: 40px;
display: flex;
align-items: center;
justify-content: center;
}

.advertise-page .advertise-title-link {
letter-spacing: -0.5px;
}

.advertise-page .advertise-card-footer {
background: transparent !important;
}

.advertise-page .bg-maroon-soft {
background: rgba(133, 28, 59, 0.05) !important;
}

.advertise-page .advertise-form-card {
border-radius: 20px;
overflow: hidden;
}

.advertise-page .advertise-format-icon {
font-size: 2.5rem;
color: var(--bs-primary);
margin-bottom: 1rem;
}

/* =========================================================================
TICKETS PAGE STYLES
========================================================================= */
.tickets-page .avatar-ticket {
width: 40px;
height: 40px;
display: flex;
align-items: center;
justify-content: center;
}

.tickets-page .ticket-category-card {
cursor: pointer;
transition: all 0.3s ease;
}

.tickets-page .ticket-category-card:hover {
transform: translateY(-5px);
box-shadow: 0 8px 15px rgba(133, 28, 59, 0.1) !important;
}

.tickets-page .btn-check:checked+.ticket-category-card {
    background: linear-gradient(72.47deg, #26050c 22.16%, rgb(126, 58, 78) 76.47%) !important;
}

.tickets-page .btn-check:checked+.ticket-category-card i,
.tickets-page .btn-check:checked+.ticket-category-card span {
color: white !important;
}

.tickets-page .form-label-premium {
font-size: 0.75rem;
font-weight: 700;
text-transform: uppercase;
letter-spacing: 0.05em;
color: #6c757d;
margin-bottom: 0.5rem;
}

.tickets-page .border-dashed-maroon {
border: 2px dashed rgba(133, 28, 59, 0.2);
background: rgba(133, 28, 59, 0.02);
transition: all 0.3s ease;
}

.tickets-page .border-dashed-maroon:hover {
border-color: rgba(133, 28, 59, 0.4);
background: rgba(133, 28, 59, 0.05);
}

/* =========================================================================
VIDEOS PAGE STYLES
========================================================================= */
.videos-page .video-play-overlay {
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
width: 50px;
height: 50px;
background: rgba(133, 28, 59, 0.9);
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
color: white;
font-size: 1.5rem;
opacity: 0.8;
transition: all 0.3s ease;
pointer-events: none;
}

.videos-page .video-card:hover .video-play-overlay {
opacity: 1;
transform: translate(-50%, -50%) scale(1.1);
}

.videos-page .avatar-video {
width: 38px;
height: 38px;
border-radius: 50%;
border: 2px solid var(--bs-primary);
object-fit: cover;
}

.videos-page .video-genre-label {
font-size: 0.65rem;
font-weight: 700;
text-transform: uppercase;
letter-spacing: 0.5px;
color: var(--bs-primary);
background: rgba(133, 28, 59, 0.1);
padding: 2px 8px;
border-radius: 4px;
}

.videos-page .video-title-link {
font-size: 0.95rem;
font-weight: 700;
color: #333;
transition: color 0.2s ease;
}

.videos-page .video-title-link:hover {
color: var(--bs-primary) !important;
}

.videos-page .video-card-footer {
background: rgba(133, 28, 59, 0.02);
}

/* =========================================================================
EPISODES PAGE STYLES
========================================================================= */
.episodes-page .avatar-episode {
width: 32px;
height: 32px;
border-radius: 50%;
border: 2px solid var(--bs-primary);
object-fit: cover;
}

.episodes-page .episode-category-label {
font-size: 0.65rem;
font-weight: 700;
text-transform: uppercase;
letter-spacing: 0.5px;
color: var(--bs-primary);
background: rgba(133, 28, 59, 0.1);
padding: 2px 8px;
border-radius: 4px;
}

.episodes-page .episode-title-link {
font-size: 0.95rem;
font-weight: 700;
color: #333;
transition: color 0.2s ease;
}

.episodes-page .episode-title-link:hover {
color: var(--bs-primary) !important;
}

.episodes-page .episode-card-footer {
background: rgba(133, 28, 59, 0.02);
}

/* =========================================================================
NEWS PUBLIC REDESIGN - PREMIUM GRID & CARDS
========================================================================= */

.news-redesign-container {
background-color: #fff;
padding: 1.5rem 0;
color: #333;
}


.news-card-premium {
position: relative;
overflow: hidden;
border-radius: 10px;
background-size: cover;
background-position: center;
height: 100%;
min-height: 200px;
cursor: pointer;
transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
border: 1px solid rgba(255, 255, 255, 0.08);
}

.news-card-premium:hover {
transform: translateY(-5px);
box-shadow: 0 12px 30px rgba(0, 0, 0, 0.6);
}

/* Smooth Gradient Overlay for Readability */
.news-card-premium::after {
content: "";
position: absolute;
top: 0;
left: 0;
right: 0;
bottom: 0;
background: linear-gradient(to bottom, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0.95) 100%);
z-index: 1;
}

.news-card-content {
position: absolute;
bottom: 0;
left: 0;
right: 0;
padding: 1rem 1.25rem;
z-index: 2;
color: #fff;
}

.visual-category-badge {
position: absolute;
top: 15px;
right: 15px;
background: var(--mshd-maroon);
color: #fff;
padding: 4px 12px;
border-radius: 4px;
font-size: 10px;
font-weight: 700;
text-transform: uppercase;
letter-spacing: 0.5px;
z-index: 2;
backdrop-filter: blur(4px);
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.news-card-title {
font-size: 1.05rem;
font-weight: 700;
line-height: 1.3;
margin-bottom: 6px;
text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
display: -webkit-box;
-webkit-line-clamp: 2;
line-clamp: 2;
-webkit-box-orient: vertical;
overflow: hidden;
}

.news-card-meta {
display: flex;
justify-content: space-between;
align-items: center;
font-size: 11px;
opacity: 0.85;
}

.news-card-stats {
display: flex;
gap: 12px;
}

.news-stat-item {
display: flex;
align-items: center;
gap: 4px;
}

/* MSHD NEWS REDESIGN STYLES */
:root {
--plyr-color-main: var(--mshd-maroon);
}

.news-grid-asymmetric {
display: flex;
flex-direction: column;
gap: 12px;
}

.news-asym-row {
display: flex;
flex-wrap: wrap;
gap: 12px;
}

.news-asym-small-side {
flex: 0 0 calc(50% - 0.75rem);
display: grid;
grid-template-columns: 1fr 1fr;
grid-template-rows: 1fr 1fr;
gap: 12px;
}

.news-asym-large-side {
flex: 0 0 calc(50% - 0.75rem);
min-height: 416px;
}

.news-asym-full-row {
flex: 0 0 100%;
display: grid;
grid-template-columns: repeat(4, 1fr);
gap: 12px;
}

@media (max-width: 1200px) {

.news-asym-small-side,
.news-asym-large-side {
flex: 0 0 100%;
}
}

@media (max-width: 768px) {
.news-asym-full-row {
grid-template-columns: repeat(2, 1fr);
}
}

@media (max-width: 575px) {
.news-asym-small-side {
grid-template-columns: 1fr;
}

.news-asym-full-row {
grid-template-columns: 1fr;
}
}

.news-card-visual-match {
position: relative;
background-size: cover;
background-position: center;
border-radius: 12px;
overflow: hidden;
cursor: pointer;
border: 1px solid rgba(255, 255, 255, 0.1);
display: flex;
flex-direction: column;
justify-content: flex-end;
}





.visual-card-footer {
background: linear-gradient(to top, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0.4) 60%, transparent 100%);
padding: 20px 25px;
display: flex;
justify-content: space-between;
align-items: flex-end;
z-index: 2;
}

.card-small .visual-card-footer {
padding: 10px 15px;
}

.visual-card-title {
color: white !important;
font-weight: 700;
margin-bottom: 5px;
line-height: 1.2;
}

.card-large .visual-card-title {
font-size: 28px;
}

.card-small .visual-card-title {
font-size: 13px;
margin-bottom: 2px;
display: -webkit-box;
-webkit-line-clamp: 2;
line-clamp: 2;
-webkit-box-orient: vertical;
overflow: hidden;
}

.visual-card-meta {
color: rgba(255, 255, 255, 0.7);
font-size: 12px;
}

.card-small .visual-card-meta {
font-size: 10px;
}

.article-body-visual {
line-height: 1.8;
color: inherit;
}

.visual-stats {
display: flex;
gap: 15px;
color: white;
}

.visual-stat-item {
display: flex;
align-items: center;
gap: 5px;
font-size: 13px;
}

.visual-stat-item i {
color: rgba(255, 255, 255, 0.8);
}

.news-redesign-container {
padding: 1.5rem 0;
color: inherit;
}

.dark-style .news-redesign-container {
background-color: #0d0f17;
color: #fff;
}

.hover-scale {
transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.hover-scale:hover {
transform: scale(1.02);
z-index: 5;
}

.news-gallery-visual,
.news-video-visual,
.news-audio-visual,
.news-pdf-visual {
animation: fadeInUp 0.5s ease backwards;
}

@keyframes fadeInUp {
from {
opacity: 0;
transform: translateY(20px);
}

to {
opacity: 1;
transform: translateY(0);
}
}

@keyframes pulse-subtle {

0%,
100% {
transform: scale(1);
opacity: 0.7;
}

50% {
transform: scale(1.02);
opacity: 0.85;
}
}

.border-dashed {
border-style: dashed !important;
}

.fs-tiny {
font-size: 0.65rem;
}

.audio-player-container {
transition: all 0.3s ease;
}

.audio-player-container:hover {
background-color: rgba(var(--mshd-maroon-rgb), 0.05) !important;
border-color: var(--mshd-maroon) !important;
}

.btn-outline-maroon {
color: var(--mshd-maroon);
border-color: var(--mshd-maroon);
}


/* News Reaction Colors */
.ti-heart-filled,
.btn-like.active i,
.visual-stat-item .ti-heart-filled {
color: #ff4d4d !important;
/* Red heart */
}

.ti-thumb-down-filled,
.btn-dislike.active i,
.visual-stat-item .ti-thumb-down-filled {
color: #696cff !important;
/* Blue-ish for dislike */
}




/*himanshu
*/

.dark-style .bg-label-secondary {
background-color: rgba(255, 255, 255, 0.1) !important;
color: #fff !important;
}

.card-footer span i.ti.ti-heart {
font-size: 12px;
}

.card-footer span i {
font-size: 16px !important;
}

.card-footer span  small {
font-size: 11px !important;
}
h6.text-truncate.fw-bold.card-title {
color: #333;
}


.event-card .card-title {
color: #333;
font-weight: 700;
text-transform: capitalize;
}




.search-icon {
position: absolute;
top: 50%;
right: 12px;
transform: translateY(-50%);
font-size: 18px;
color: #999;
}
.dark-style input.form-control.custom-search-input {
background: transparent;
font-size: 12px;
color: #fff;
border-radius: 25px;
border-color: #fff;
}
.dark-style .custom-search-input::placeholder {
color: #fff!important;
font-size: 12px;
}
.search-wrapper {
position: relative;
width: 250px;
}
.dark-style i.ti.ti-search.search-icon {
color: #fff;
}
input.form-control.custom-search-input {
border-radius: 25px;
}
.p-2 {
padding: 1rem !important;
}

hover:a.add-class {
border-color: #fff;
text-decoration: none;
}
.btn-light {
color: #fff;
background-color: var(--mshd-maroon) !important;
border-color: var(--mshd-maroon) !important;
text-decoration: none !important;
}


.article-body-visual.mb-5 {
    max-height: 400px;
    overflow-y: auto;
    padding-right: 10px;
    scrollbar-width: none;
}

.dark-style .news-redesign-container {
background-color: transparent;
color: #fff;
}

.bg-label-maroon i {
color: var(--mshd-maroon) !important;
position: relative;
top: -3px;
}
.light-style .news-redesign-container {
background: transparent;
border-radius: 0px !important;
box-shadow: none !important;
}
.singleNews-main .single-news-card {
width: 100%;
}

.dark-style .article-body-visual.mb-5 h3 {
color: #fff;
}

.dark-style .article-body-visual.mb-5 li {
color: #fff;
}


/* Sponsored Label */
.sponsored-label {
position: absolute;
top: 15px;
left: 25px;
font-size: 10px;
letter-spacing: 2px;
color: #fff;
}



.premium-ad-card .ad-logo {
    height: 55px;
    position: relative;
    top: -5px;
}

.ad-bottom-box {
    color: #fff;
    font-size: 14px;
    letter-spacing: 1px;
    text-align: center;
    padding-left: 40px;
}

.ad-bottom-box {
    text-align: center;
    color: #fff;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 100;
}
.ad-bottom-box p {
    color: #fff;
    font-size: 13px;
    margin: 0;
}

h4.fw-bold.mb-2 {
font-size: 20px !important;
}

img.w-100.object-fit-cover {
object-fit: cover !important;
}
.home-logos {
    display: flex;
    justify-content: center;
}

.add-background-news i {
font-size: 12px;
}


.dark-style .text-muted.add-white {
color: #fff;
}

.comment-content {
position: relative;
top: -22px;
}
.see-all-btn:hover {
background: #685dd8 !important;
}
.dark-style .see-all-btn {
border-color:#fff !important;
color:#fff !important;
}


.news-card {
display: flex;
flex-direction: column;
border-radius: 12px;
overflow: hidden;
transition: 0.3s ease;
height: 100%;
}

.news-card:hover {
transform: translateY(-5px);
box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.news-img-wrapper {
width: 100%;
height: 200px;   /* Sab images same height */
overflow: hidden;
}

.news-img-wrapper img {
width: 100%;
height: 100%;
object-fit: cover;   /* VERY IMPORTANT */
}

.news-overlay {
position: absolute;
bottom: 0;
left: 0;
right: 0;
padding: 6px 10px;
background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
}

.news-title {
font-size: 14px;
line-height: 1.4;
}

.news-desc {
font-size: 13px;
display: -webkit-box;
-webkit-line-clamp: 3;
-webkit-box-orient: vertical;
overflow: hidden;
}


.navbar-expand-lg {
margin: 20px 11px !important;
}

a.btn.btn-light.btn-sm.fw-bold.border.px-3:hover {
background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%);
border: none !important;
}
span.dark-c {
color: #000;
}

.light-style .news-detail-header.mb-4.mt-2 {
    border-radius: 0.375rem !important;
    padding: 8px 20px;
    background: rgba(255, 255, 255, 0.95) !important;
    box-shadow: 0 0.25rem 1rem rgba(165, 163, 174, 0.45) !important;
    margin-top: 10px !important;
    margin-bottom: 16px !important;
}
.add-background-news {
background: #1e2124;
padding: 3px 8px;
border-radius: 10px;
}
.dark-style input.form-control.form-control-sm.rounded-start-pill::placeholder {
color: #fff !important;
}
div#musicNavbarContent {
justify-content: end;
}
a.navbar-brand.fw-bold.ms-2 {
text-decoration: none !IMPORTANT;
}
a.navbar-brand.fw-bold.ms-2 {
margin-right: 14px !important;
}
a.navbar-brand.fw-bold {
text-decoration: none!important;
}
.d-none.d-xl-flex.gap-3.align-items-center.ms-2.text-dark span i {
font-size: 18px !important;
}
.input-group.input-group-merge.rounded-pill {
border-color: #fff !important;
}
.d-none.d-xl-flex.gap-3.align-items-center.ms-2.text-dark {
position: relative;
top: -1px;
}
.dark-style .filter-select option {
background-color: #272729;
color: #fff;
}
.dark-style .empty-state.py-5.rounded h3.mb-2 {
color: #fff;
}

.dark-style .news-detail-header.mb-4.mt-2 {
    background: rgba(40, 40, 42, 0.95) !important;
    border-radius: 0.375rem !important;
    padding: 12px 20px;
    margin-top: 0px !important;
    margin-bottom: 16px !important;
}
.menu-inner-shadow {
display: none !important;
}
@media (max-width: 768px) {
ul.navbar-nav.d-flex.flex-row.align-items-center {
display: none !important;
}
}
@media (max-width: 576px) {
div#navbar-collapse a.app-brand-link.me-2 {
display: none;
}
.layout-menu-toggle.navbar-nav.align-items-xl-center.me-3.me-xl-0.d-xl-none {
margin: 0 !important;
}
.input-group.input-group-merge.input-group-sm.rounded-pill {
width: 138px !important;
margin: 0 10px;
}
li.nav-item.dropdown.me-2.me-xl-0 {
margin: 0 !important;
}

li.nav-item.dropdown-notifications.navbar-dropdown.dropdown.me-3.me-xl-1 {
margin: 0 2px !important;
}
.d-flex.align-items-center.gap-3 {
justify-content: center;
}
}

@media (max-width: 320px) {
.input-group.input-group-merge.input-group-sm.rounded-pill {
width: 111px !important;
}
}
@media (max-width: 425px) {

.input-group.input-group-merge.input-group-sm.rounded-pill {
width: 208px !important;
}
}

.row.g-4 {
padding-left: 12px;
}

.dark-style .card-footer small.fw-bold {
color: #fff !important;
}

.card-footer span {
color: #fff !important;
}

.grid-item-sidbar {display: grid;grid-template-columns: auto auto;flex-wrap: wrap;gap: 0px;}

.singleNews-main .col-lg-5 {
padding-left: 0;
}

.search-box input {
    color: white;
    border: 1px solid #efeff1;
}
.card-footer span {
    color: #566a7f !important;
}

a.add-class {
    border-color: #000;
    text-decoration: none;
    color: var(--mshd-maroon);
    font-weight: 700;
}


.light-style .input-group.input-group-merge.rounded-pill {
    border-color: #dbdade !important;
}

.dark-style .bg-label-maroon i {
    color: #fff !important;
    position: relative;
    top: 0px;
}
.dark-style .card .card-text, .dark-style .event-card .card-text {
color: #fff !important;
font-size: 10px !important;
text-transform: capitalize;
}
.avatar.avatar-xs.rounded.overflow-hidden.flex-shrink-0 {
    background: inherit !important;
}
.videos-sarch input#searchMusic {
    border: none;
    font-size: 12px;
}
.videos-sarch .input-group {
    padding-right: 12px;
}
.videos-sarch .input-group i {
    font-size: 18px !important;
}
.news-slider .card1{
padding:10px;
}

.slick-slide{
margin:0 10px;
}

.slick-track{
display:flex;
}

input.search-event.form-control {
    font-size: 12px;
    color: #fff;
}
.dark-style input.search-event.form-control::placeholder {
    color: #fff !important;
    opacity: 1;
}
.premium-ad-card {
    background: #272729;
    border-radius: 8px;
    margin: 10px 0;
    padding-bottom: 15px;
}
.singleNews-main .single-news-card {
    width: 100%;
    display: flex;
    gap: 15px;
}
.singleNews-main .single-news-card .card-small {
    width: 50% !important;
    height: 100% !important;
}
.singleNews-main .single-news-card .card-small h5.hero-title.p-0 {
    font-size: 8px !important;
}

.singleNews-main .single-news-card .card-small i.ti.ti-clock.me-1 {
    font-size: 10px;
}

.singleNews-main .single-news-card .card-small span {
    font-size: 8px;
}

.singleNews-main .single-news-card .card-small span.reaction-item {
    padding: 0 5px;
}
.singleNews-main .single-news-card .card-small  .hero-overlay {
    padding: 5px 4px;
}
.singleNews-main .single-news-card .card-small .hero-category {
    font-size: 8px !important;
    padding: 3px 7px !important;
}
a.btn.btn-primary.btn-lg.rounded-pill.px-4.shadow-sm.waves-effect.waves-light {
    text-decoration: none;
}
a.app-brand-link {
    text-decoration: none;
}
.media-card-premium .card-body i.ti.ti-microphone-2.me-1 {
    display: none;
}
.avatar.avatar-sm.logo-set {
    display: flex;
    justify-content: center;
    color: #000 !important;
}

div#event-row {
    padding-right: 11px;
}
.dark-style .avatar.avatar-sm.logo-set {
    color: #fff !important;
}
.play-overlay-center {
    display: none;
}
button.add-follow.btn.btn-xs.rounded-pill.px-2.py-1.waves-effect.waves-light {
    background: #fff;
    color: #000 !important;
    font-weight: 900;
    position: relative;
    left: 55px;
    top: -15px;
}


.followers {
    background: #f1f1f1;
    padding: 3px 5px;
    display: flex;
    align-items: center;
    gap: 0px;
    font-weight: 900;
    border-radius: 25px;
    margin: 1px 0px 1px 2px;
}

.follow-text {
    padding: 5px;
    font-weight: 900;
    cursor: pointer;
    color: #000;
}

span.followers {
    color: #000;
}
.followers i.ti.ti-users {
    color: #000;
    font-size: 10px;
}


.badge.bg-dark-opacity.text-white.px-2.py-1 {
    position: relative;
    right: 68px;
    top: 8px;
    color: #fff !important;
}

.badge.bg-dark-opacity.text-white.px-2.py-1 small {
    font-size: 7px !important;
}

.badge.bg-dark-opacity.text-white.px-2.py-1 i {
    font-size: 16px;
}
.cardposition-overlay i {
    font-size: 16px;
}
a.btn {
    text-decoration: none;
}


.follow-pill {
    background: #ffffff;
    border-radius: 30px;
    font-size: 11px;
    border: 1px solid #000;
    padding: 3px 8px;
    font-weight: bolder;
    position: absolute;
    right: 13px;
}
div#globalPersistentPlayer {
    background: #1e2124;
}
.shop-icon.avatar-sm.bg-label-maroon.rounded.p-1.flex-shrink-0.avatar-shop {
    position: relative;
    top: -9px;
}
.policies-icon.avatar.avatar-sm.bg-label-maroon.rounded.p-1.flex-shrink-0 {
    display: flex;
    justify-content: center;
    
}
span.total-models.transition-all {
    display: flex;
    gap: 7px;
    padding-top: 3px;
}
div#videoGrid {
    padding-right: 12px;
}
div#videoGrid .card-header {
    padding-left: 16px;
    padding-right: 30px;
}
.dark-style p.lead.mb-4.mx-auto {
    color: #fff;
}
div#policy-content {
    padding-right: 12px;
}
.dark-style .add-b-c.d-none.d-xl-flex.gap-2 a.btn {
}






.dark-style .advertismant-form {background: #1e2124 !important;}

.dark-style input.form-control.rounded-pill.px-3 {
    font-size: 12px;
}
.dark-style .form-control.rounded-pill.px-3 {
    color: #9095b4 !important;
    font-size: 12px;
}

.dark-style .advertismant-form input::placeholder {
    color: #fff;
}
.dark-style .advertismant-form input {
    border-color: #fff;
}

.dark-style .advertismant-form textarea {
    border-color: #fff;
    font-size: 12px;
}
.dark-style .advertismant-form textarea::placeholder {
    color: #fff;
}
.advertismant-form .form-control {
    height: inherit;
}

.add-font-style {
    margin-left: 16px;
}

.add-font-style i {
    font-size: 27px !important;
}

.add-font-style h2 {
    font-size: 25px;
}

.Sidebar-p .add-new-change .news-hero-card.card-small {
    height: 180px !important;
}
.dark-style strong.small {
    color: #fff;
}
.lost-fonund-title {
    padding: 0 14px;
}

button.btn.btn-sm.bg-maroon-opacity.border-0.p-2.follow-btn.waves-effect.waves-light {
    display: none !important;
}
input#searchBoxLostFound {
    background: transparent;
    font-size: 12px;
    color: #fff !important;
    margin: 0 !important;
    padding-right: 50px;
}
button.jobs-page.btn.btn-sm.btn-primary.bg-maroon.border-maroon.waves-effect.waves-light.claim-btn {
    font-size: 10px !important;
    top: 66px;
}

button.btn.btn-sm.bg-maroon.text-white.border-0.px-3.rounded-pill.shadow-sm {
    font-size: 10px !important;
    position: relative;
    top: 50px;
}
button#playBtn-1126 {
    padding: 10px  !important;
    background: #851c1ca1 !important;
}
button#playBtn-1124 {
    padding: 10px !important;
       background: #851c1ca1 !important;
}
.dark-style span.total-podcasts i {
    color: #fff;
}
.dark-style span#podcastCount {
    color: #fff;
}

 span.total-podcasts i {
    color: #000;
}
span#podcastCount {
    color: #000;
}  
button.event-btn {
    padding: 5px 10px 5px 10px !important;
    border-radius: 0px !important;
}
button.event-btn i {
    font-size: 18px;
}
button.event-btn span {
    font-size: 13px !important;
}

#event-row .event-card {
    transition: transform 0.3s ease;
    height: 350px !important;
}

.artist-button {
    top: 27px !important;
    margin-right: 17px;
}
.artist-button a.btn.btn-sm.bg-maroon.text-white.border-0.px-3.rounded-pill.shadow-sm.waves-effect.waves-light:hover {
    background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%) !important;
}
div#artists-row {
    padding-right: 12px;
}
button.presenters-btn {
    top: 5px !important;
}
.row.g-4.text-center.stats-row.card-set {
    padding-right: 12px;
}

.row.g-4.card-set {
    padding-right: 12px;
}
nav.navbar.navbar-expand-lg.bg-navbar-theme.mb-4.mt-4.rounded.shadow.navbar-sub-header {
    border-radius: 8px;
}
.feeds-page .hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=2070');
    background-size: cover;
    background-position: center;
    padding: 100px 40px;
    margin: 10px 12px !important;
    border-radius: 8px;
    height: 500px;
}

div#servicesGrid {
    padding-right: 12px;
}
div#servicesGrid {
    padding-right: 12px;
}
div#feeds-row {
    padding-right: 12px;
}
.set-he-icon {
    position: relative;
    top: -1px !important;
}
div#shop-content {
    padding-right: 12px;
}
.avatar.avatar-xs.rounded.overflow-hidden.flex-shrink-0 {
    border-radius: 5px;
}
div#episodes-row {
    padding-right: 12px;
}
.evente-logo.avatar.avatar-sm.bg-label-maroon.rounded.p-1.flex-shrink-0 {
    text-align: center;
}
.evente-logo.avatar.avatar-sm.bg-label-maroon.rounded.p-1.flex-shrink-0 {
    text-align: center;
}
.add-gag {
    gap: 0 !important;
}
.add-new-color span.ms-1.small {
    color: #fff;
}
.add-new-color.open-lightbox-video-11 {
    backdrop-filter: blur(2px) !important;
}
.card-header.border-bottom-0.pb-0.d-flex.align-items-center.pb-1 {
    gap: 0px !important;
}
.avatar-sm {
    width: 40px;
    height: 40px;
}
.card-title + small {
    display: block !important;
    margin-top: 5px !important;
}

.light-style button.jobs-page.btn.btn-sm.btn-primary.bg-maroon.border-maroon.waves-effect.waves-light.claim-btn {
    font-size: 10px !important;
    top: 69px;
}
.light-style button.btn.btn-sm.bg-maroon.text-white.border-0.px-3.rounded-pill.shadow-sm {
    font-size: 10px !important;
    position: relative;
    top: 68px;
}
.add-new-c.avatar.avatar-sm.bg-label-maroon.rounded.p-1.flex-shrink-0 {
    display: flex;
    justify-content: center;
}
.card-header.border-bottom-0.pb-0.d-flex.align-items-center {
    gap: 0 !important;
}
a.avatar.avatar-sm.flex-shrink-0 {
    margin-right: 8px;
}
.avatar.avatar-sm.rounded-circle.overflow-hidden.flex-shrink-0.bg-label-maroon.p-0 {
    margin-right: 10px;
}
div#artistsNavbarContent {
    justify-content: end !important;
}
.artist-pill {
    background: #ffffff;
    border-radius: 30px;
    font-size: 11px;
    border: 1px solid #000;
    padding: 3px 5px;
    font-weight: bolder;
}
.background-color {
    background: #272729;
    padding: 30px !important;
}
button.event-btn.btn.btn-sm.bg-maroon-opacity.border-0.add-new-color.open-lightbox-video-11 {
    background: #851c1ca1 !important;
    border-radius: 3px !important;
}
.Music-buttons {
    display: flex;
    align-items: center;
    color: #fff;
    font-weight: bolder;
    text-transform: capitalize;
}


.home-logos {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 !important;
}
h6.mb-0.text-truncate.fw-bold.card-title {
    line-height: 1 !important;
    margin-bottom: 0px !important;
    font-size: 11px;
}
button.event-btn.text-white.btn.btn-sm.bg-maroon-opacity.border-0.pt-1 {
    background: #851c1ca1 !important;
    border-radius: 3px !important;
}
.light-style p.card-text.text-muted.small.mb-0.line-clamp-3 {
    font-size: 10px;
}
.light-style .follow-text-pp {
    color: #000;
}
.Sidebar-p .add-new-change .news-hero-card.card-small .card-footer-news {
    display: none;
}
.Sidebar-p .add-new-change .news-hero-card.card-small .top-box {
    padding: 6px  5px !important;
}

.Sidebar-p .add-new-change .news-hero-card.card-small i.ti.ti-news.me-1.mb-1 {
    font-size: 16px;
    margin-bottom: 0 !important;
}

.Sidebar-p .add-new-change .news-hero-card.card-small .hero-category {
    padding: 2px 4px !important;
}
.Sidebar-p .add-new-change .news-hero-card.card-small .hero-meta {
    padding: 0;
}

.Sidebar-p .add-new-change .news-hero-card.card-small span.follow-text {
    font-size: 10px;
}
.Sidebar-p .add-new-change .news-hero-card.card-small .hero-image {
    height: 183px;
}
.accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
}

.card-footer-news {
    display: none;
}
.light-style .top-box {
    background: #fff;
}

.light-style .top-box h5.hero-title.p-0.d-flex.align-items-center {
    color: #000;
}

.light-style .hero-desc.py-3.px-3.border-bottom {
    background: #fff;
}
.light-style .hero-reactions-wrapper {
    background: #fff;
}
.light-style .reaction-icons.d-flex.mx-3.my-3.px-3.py-2 {
    background: #f2f2f3 !important;
}
.light-style span.reaction-item {
    color: #566a7f !important;
}
 .reaction-icons.d-flex.mx-3.my-3.px-3.py-2 {
    background: rgba(255, 255, 255, 0.1) !important;
}
.hero-section .text-center.position-relative.z-2 {
    margin-top: 75px;
}
.tickets-page .card-header {
    background: linear-gradient(72.47deg, #26050c 22.16%, rgb(126, 58, 78) 76.47%);
}
.tickets-page .card-header .avatar i {
    font-size: 30px !important;
}
.tickets-page .card-header h4.fw-bold.text-white.m-0 {
    font-size: 18px !important;
}
.tickets-page .card {
    margin: 0 11px;
}
.tickets-page .open-tic {
    background: linear-gradient(72.47deg, #26050c 22.16%, rgb(126, 58, 78) 76.47%);
    color: #fff;
    border: none;
}
.tickets-page .open-tic:hover {
    background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%);
}
.dark-style .tickets-page label.form-label-premium {
    color: #fff;
}
.dark-style .tickets-page  input.form-control.border-0.ps-0 {
    padding: 0;
    border: none;
}
.dark-style .tickets-page  span.input-group-text.bg-transparent.border-0 {
    border: none;
}
.dark-style .tickets-page input.form-control.border-0.ps-0::placeholder {
    color: #fff;
    font-size: 12px;
}
.dark-style .tickets-page input.form-control {
    border-color: #fff;
}
.tickets-page input.form-control::placeholder {
    color: #fff;
}
textarea.form-control::placeholder {
    color: #fff;
}
.dark-style .tickets-page textarea {
    border-color: #fff;
}
.dark-style .tickets-page .border-dashed-maroon {
    border: 2px dashed #fff;
}
.dark-style .tickets-page .border-dashed-maroon {
    border: 2px dashed #fff;
}

.tickets-page .cta-section a {
    text-decoration: none;
    background: linear-gradient(72.47deg, #26050c 22.16%, rgb(126, 58, 78) 76.47%);
    border: none;
    color: #fff;
}
.dark-style .tickets-page .border-dashed-maroon p {
    color: #fff;
}
.tickets-page .cta-section a:hover {
    background: #685dd8;
}
.dark-style .tickets-page .cta-section {
    border-color: #fff !important;
    margin: 0 11px;
    border-radius: 4px;
}
.tickets-page button {
    background: linear-gradient(
72.47deg, #26050c 22.16%, rgb(126, 58, 78) 76.47%) !important;
    color: #fff;
    border: none !important;
}
.light-style .tickets-page input::placeholder {
    color: #6f6b7d;
}
.light-style .tickets-page span {
    padding-left: 18px;
    padding-right: 12px;
}
.tickets-page button:hover {
    background: #7367f0 !important;
}
.tickets-page input.form-control {
    height: 35px;
}
textarea.form-control {
    height: 160px;
}
.badge.contact-us {
    font-size: 18px;
    border: 1px solid #fff;
    border-radius: 25px;
    padding: 10px 22px;
}
.badge.contact-us:hover {
    background: #851c3b;
    border-color: #851c3b;
}

.dark-style .contact-card.text-center.p-4 {
    background: #2a2126 !important;
}
.icon-box {
    width: 60px;
    height: 60px;
    margin: 0 auto;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(72.47deg, #851c3b 22.16%, rgb(126, 58, 78) 76.47%);
    color: #fff;
    font-size: 24px;
}
.dark-style .contact-card h5 {
    color: #fff;
}
.dark-style .contact-card p {
    color: #fff;
}
.dark-style .contact-link {
    color: #fff;
}

.contact-card {
    background: #fff;
    border-radius: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}
.text-heading.massge {
    font-size: 20px !important;
    font-weight: 600;
}

.contact-link {
    font-weight: 600;
    text-decoration: none !important;
    color: #851c3b;
}
.dark-style  .contactus-form label {
    color: #fff;
}
.dark-style .contactus-form input.form-control {
    border-color: #fff;
}
.dark-style .contactus-form input.form-control::placeholder {
    color: #fff;
}
.dark-style .contactus-form .input-group.input-group-merge {
    border: 1px solid #fff;
}
.contactus-form span.input-group-text {
    border: none;
    margin-top: 2px;
}

.dark-style .contactus-form textarea.form-control {
    border-color: #fff;
}
.dark-style .contactus-form  input#subject {
    border: none;
}
.contactus-form input.form-control {
    height: 45px;
}
.contactus-form input-group.input-group-merge {
    border: 1px solid #dbdade;
}
.contaus-form ctinput#subject {
    border: none;
}
.contactus-form i.ti.ti-help {
    margin-right: 0px;
    margin-top: 12px;
}
.light-style .contactus-form i.ti.ti-help {
    margin-top: 0px;
    margin-right: 8px;
}
.light-d {
    border: 1px solid #dbdade;
    padding-left: 8px;
}
.light-d input.form-control {
    border: none;
}
.dark-style .light-d {
    padding: 0;
}
.add-classn:hover {
    background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%);
    border-color: #7460df;
}
.add-classn {
    text-decoration: none !important;
    border: 1px solid #fff;
    padding: 5px 16px;
    border-radius: 5px;
}
.light-style .add-classn:hover {
    border-color: #7851ba00 !important;
    color: #fff;
}
.light-style .add-classn {
    border: 1px solid #851c3b;
    color: #851c3b;
}

.home-arrow {
    margin-right: 10px;
}

button.play-btn {
    width: 35px;
    height: 35px;
    background: #e91e63;
    border-radius: 50%;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}
.vieod-title-profile.d-flex {
    margin-left: 24px;
    margin-top: 10px;
    align-items: center !important;
    margin-bottom: 15px;
}
</style>
<div class="content-wrapper">
            <!-- Content -->
<div class="col-md">

      <div id="carouselExampleDark" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2" class="active" aria-current="true"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item">
            <img class="d-block w-100" src="https://www.ttunikit.co.za/assets/img/wil/Work_Integrated_Learning.png" alt="First slide">
            <div class="carousel-caption d-none d-md-block">

            </div>
          </div>
          <div class="carousel-item active">
            <img class="d-block w-100" src="https://www.ttunikit.co.za/assets/img/wil/TTUNIKWIL.png" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
           
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://www.ttunikit.co.za/assets/img/wil/TireloTTUNIK.png" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
              
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </a>
      </div>
    </div>














<div class="hero-section overflow-hidden position-relative mb-5 shadow-lg" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&amp;w=2071'); background-size: cover;    margin: 0px 0px !important ;
    border-radius: 0px;     height: 200px;">
        <div class="text-center position-relative z-2">
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('wil_application') }}" class="btn btn-maroon btn-lg rounded-pill px-5">Apply For Work Integrated Learning</a>
            </div>
        </div>
    </div>
    
    <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
       

              <div class="row mt-6">
                <!-- Navigation -->
                <div class="col-lg-3 col-md-4 col-12 mb-md-0 mb-4">
                  <div class="d-flex justify-content-between flex-column nav-align-left mb-2 mb-md-0">
                    <ul class="nav nav-pills flex-column" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active waves-effect waves-light" data-bs-toggle="tab" data-bs-target="#payment" aria-selected="true" role="tab">
                          <i class="icon-base ti tabler-credit-card icon-sm faq-nav-icon me-1_5"></i>
                          <span class="align-middle">Onbaording Fee</span>
                        </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link waves-effect waves-light" data-bs-toggle="tab" data-bs-target="#delivery" aria-selected="false" tabindex="-1" role="tab">
                          <i class="icon-base ti tabler-briefcase icon-sm faq-nav-icon me-1_5"></i>
                          <span class="align-middle">Delivery</span>
                        </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link waves-effect waves-light" data-bs-toggle="tab" data-bs-target="#cancellation" aria-selected="false" tabindex="-1" role="tab">
                          <i class="icon-base ti tabler-rotate-clockwise-2 icon-sm faq-nav-icon me-1_5"></i>
                          <span class="align-middle">Cancellation &amp; Return</span>
                        </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link waves-effect waves-light" data-bs-toggle="tab" data-bs-target="#orders" aria-selected="false" tabindex="-1" role="tab">
                          <i class="icon-base ti tabler-box icon-sm faq-nav-icon me-1_5"></i>
                          <span class="align-middle">My Orders</span>
                        </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link waves-effect waves-light" data-bs-toggle="tab" data-bs-target="#product" aria-selected="false" tabindex="-1" role="tab">
                          <i class="icon-base ti tabler-settings icon-sm faq-nav-icon me-1_5"></i>
                          <span class="align-middle">Product &amp; Services</span>
                        </button>
                      </li>
                    </ul>
                    <div class="d-none d-md-block">
                      <div class="mt-4">
                        <img src="../../assets/img/illustrations/girl-sitting-with-laptop.png" class="img-fluid" width="270" alt="FAQ Image">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Navigation -->

                <!-- FAQ's -->
                <div class="col-lg-9 col-md-8 col-12">
                  <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="payment" role="tabpanel">
                      <div class="d-flex mb-4 gap-4 align-items-center">
                        <div>
                          <span class="badge bg-label-primary rounded h-px-50 py-2">
                            <i class="icon-base ti tabler-credit-card icon-30px"></i>
                          </span>
                        </div>
                        <div>
                          <h5 class="mb-0">
                            <span class="align-middle">Administration Fee</span>
                          </h5>
                          <span>Learn more about onboarding process</span>
                        </div>
                      </div>
                      <div id="accordionPayment" class="accordion">
                        <div class="card accordion-item active">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#accordionPayment-1" aria-controls="accordionPayment-1">
                             Onboarding Registration Fees
                            </button>
                          </h2>

                          <div id="accordionPayment-1" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                          TT UNIK IT SOLUTIONS offers a premium Work Integrated Learning (WIL) programme. To enrol, candidates are required to pay a once-off administration fee of R900.
This programme is more than a work integrated learning initiative—it is a platform that equips students and graduates with valuable skills in Information Technology, Media and Broadcasting, Telecommunications, Business Administration, and Finance or Banking.
Our WIL platform unlocks opprotunities of candicates to become employble or starting businesses. 

                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPayment-2" aria-controls="accordionPayment-2">
                              How do I pay for my Registration Fee?
                          </h2>
                          <div id="accordionPayment-2" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              We accept Visa® and MasterCard® or EFT. Our servers encrypt all
                              information submitted to them, so you can be confident that your credit card information
                              will be kept safe and secure. Our Banking Details are as follows: <br>Bank Name: First National Bank<br> Account Number: 62426701620 <br>Reference: Full Names
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPayment-3" aria-controls="accordionPayment-3">
                              What should I do if I'm having trouble placing an order?
                            </button>
                          </h2>
                          <div id="accordionPayment-3" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              For any technical difficulties you are experiencing with our website, please contact us at
                              our
                              <a href="javascript:void(0);">support portal</a>, or you can call us toll-free at
                              <span class="fw-medium">1-000-000-000</span>, or email us at
                              <a href="javascript:void(0);">order@companymail.com</a>
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPayment-4" aria-controls="accordionPayment-4">
                              Which license do I need for an end product that is only accessible to paying users?
                            </button>
                          </h2>
                          <div id="accordionPayment-4" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              If you have paying users or you are developing any SaaS products then you need an Extended
                              License. For each products, you need a license. You can get free lifetime updates as well.
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPayment-5" aria-controls="accordionPayment-5">
                              Does my subscription automatically renew?
                            </button>
                          </h2>
                          <div id="accordionPayment-5" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              No, This is not subscription based item.Pastry pudding cookie toffee bonbon jujubes
                              jujubes powder topping. Jelly beans gummi bears sweet roll bonbon muffin liquorice. Wafer
                              lollipop sesame snaps.
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="delivery" role="tabpanel">
                      <div class="d-flex mb-4 gap-4">
                        <div>
                          <span class="badge bg-label-primary rounded h-px-50 py-2">
                            <i class="icon-base ti tabler-briefcase icon-30px"></i>
                          </span>
                        </div>
                        <div>
                          <h5 class="mb-0">
                            <span class="align-middle">Delivery</span>
                          </h5>
                          <span>Get help with delivery</span>
                        </div>
                      </div>
                      <div id="accordionDelivery" class="accordion">
                        <div class="card accordion-item active">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#accordionDelivery-1" aria-controls="accordionDelivery-1">
                              How would you ship my order?
                            </button>
                          </h2>

                          <div id="accordionDelivery-1" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                              For large products, we deliver your product via a third party logistics company offering
                              you the “room of choice” scheduled delivery service. For small products, we offer free
                              parcel delivery.
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionDelivery-2" aria-controls="accordionDelivery-2">
                              What is the delivery cost of my order?
                            </button>
                          </h2>
                          <div id="accordionDelivery-2" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              The cost of scheduled delivery is $69 or $99 per order, depending on the destination
                              postal code. The parcel delivery is free.
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionDelivery-4" aria-controls="accordionDelivery-4">
                              What to do if my product arrives damaged?
                            </button>
                          </h2>
                          <div id="accordionDelivery-4" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              We will promptly replace any product that is damaged in transit. Just contact our
                              <a href="javascript:void(0);">support team</a>, to notify us of the situation within 48
                              hours of product arrival.
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="cancellation" role="tabpanel">
                      <div class="d-flex mb-4 gap-4">
                        <div>
                          <span class="badge bg-label-primary rounded h-px-50 py-2">
                            <i class="icon-base ti tabler-rotate-clockwise-2 icon-30px"></i>
                          </span>
                        </div>
                        <div>
                          <h5 class="mb-0"><span class="align-middle">Cancellation &amp; Return</span></h5>
                          <span>Get help with cancellation &amp; return</span>
                        </div>
                      </div>
                      <div id="accordionCancellation" class="accordion">
                        <div class="card accordion-item active">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#accordionCancellation-1" aria-controls="accordionCancellation-1">
                              Can I cancel my order?
                            </button>
                          </h2>

                          <div id="accordionCancellation-1" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                              <p>
                                Scheduled delivery orders can be cancelled 72 hours prior to your selected delivery date
                                for full refund.
                              </p>
                              <p class="mb-0">
                                Parcel delivery orders cannot be cancelled, however a free return label can be provided
                                upon request.
                              </p>
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionCancellation-2" aria-controls="accordionCancellation-2">
                              Can I return my product?
                            </button>
                          </h2>
                          <div id="accordionCancellation-2" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              You can return your product within 15 days of delivery, by contacting our
                              <a href="javascript:void(0);">support team</a>, All merchandise returned must be in the
                              original packaging with all original items.
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" aria-controls="accordionCancellation-3" data-bs-target="#accordionCancellation-3">
                              Where can I view status of return?
                            </button>
                          </h2>
                          <div id="accordionCancellation-3" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              <p>Locate the item from Your <a href="javascript:void(0);">Orders</a></p>
                              <p class="mb-0">Select <span class="fw-medium">Return/Refund</span> status</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="orders" role="tabpanel">
                      <div class="d-flex mb-4 gap-4">
                        <div>
                          <span class="badge bg-label-primary rounded h-px-50 py-2">
                            <i class="icon-base ti tabler-box icon-30px"></i>
                          </span>
                        </div>
                        <div>
                          <h5 class="mb-0">
                            <span class="align-middle">My Orders</span>
                          </h5>
                          <span>Order details</span>
                        </div>
                      </div>
                      <div id="accordionOrders" class="accordion">
                        <div class="card accordion-item active">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#accordionOrders-1" aria-controls="accordionOrders-1">
                              Has my order been successful?
                            </button>
                          </h2>

                          <div id="accordionOrders-1" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                              <p>
                                All successful order transactions will receive an order confirmation email once the
                                order has been processed. If you have not received your order confirmation email within
                                24 hours, check your junk email or spam folder.
                              </p>
                              <p class="mb-0">
                                Alternatively, log in to your account to check your order summary. If you do not have a
                                account, you can contact our Customer Care Team on
                                <span class="fw-medium">1-000-000-000</span>.
                              </p>
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionOrders-2" aria-controls="accordionOrders-2">
                              My Promotion Code is not working, what can I do?
                            </button>
                          </h2>
                          <div id="accordionOrders-2" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              If you are having issues with a promotion code, please contact us at
                              <span class="fw-medium">1 000 000 000</span> for assistance.
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionOrders-3" aria-controls="accordionOrders-3">
                              How do I track my Orders?
                            </button>
                          </h2>
                          <div id="accordionOrders-3" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              <p>
                                If you have an account just sign into your account from
                                <a href="javascript:void(0);">here</a> and select
                                <span class="fw-medium">“My Orders”</span>.
                              </p>
                              <p class="mb-0">
                                If you have a a guest account track your order from
                                <a href="javascript:void(0);">here</a> using the order number and the email address.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="product" role="tabpanel">
                      <div class="d-flex mb-4 gap-4">
                        <div>
                          <span class="badge bg-label-primary rounded h-px-50 py-2">
                            <i class="icon-base ti tabler-camera icon-30px"></i>
                          </span>
                        </div>
                        <div>
                          <h5 class="mb-0">
                            <span class="align-middle">Product &amp; Services</span>
                          </h5>
                          <span>Get help with product &amp; services</span>
                        </div>
                      </div>
                      <div id="accordionProduct" class="accordion">
                        <div class="card accordion-item active">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#accordionProduct-1" aria-controls="accordionProduct-1">
                              Will I be notified once my order has shipped?
                            </button>
                          </h2>

                          <div id="accordionProduct-1" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                              Yes, We will send you an email once your order has been shipped. This email will contain
                              tracking and order information.
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionProduct-2" aria-controls="accordionProduct-2">
                              Where can I find warranty information?
                            </button>
                          </h2>
                          <div id="accordionProduct-2" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              We are committed to quality products. For information on warranty period and warranty
                              services, visit our Warranty section <a href="javascript:void(0);">here</a>.
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionProduct-3" aria-controls="accordionProduct-3">
                              How can I purchase additional warranty coverage?
                            </button>
                          </h2>
                          <div id="accordionProduct-3" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              For the peace of your mind, we offer extended warranty plans that add additional year(s)
                              of protection to the standard manufacturer’s warranty provided by us. To purchase or find
                              out more about the extended warranty program, visit Extended Warranty section
                              <a href="javascript:void(0);">here</a>.
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /FAQ's -->
              </div>
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>
            <div class="content-backdrop fade"></div>
          </div>

          @endsection
