<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="css/flipdown.css" />
<script src="js/flipdown.js"></script>
<script src="script.js"></script>

<head>
    <title>Christmas Tree</title>
    <meta charset="utf-8" />
    <link rel="icon" href="./static/favicon.ico" />
    <link rel="apple-touch-icon" href="./static/apple-touch-icon.png" />
    <link rel="manifest" href="./static/site.webmanifest" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="theme-color" content="#FFFFFF" />
    <link rel="stylesheet" type="text/css" href="./index.css" />
    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    
</head>
<style>
    /* THEMES */

    /********** Theme: dark **********/
    /* Font styles */
    .flipdown.flipdown__theme-dark {
        font-family: sans-serif;
        font-weight: bold;
    }

    /* Rotor group headings */
    .flipdown.flipdown__theme-dark .rotor-group-heading:before {
        color: #000000;
    }

    /* Delimeters */
    .flipdown.flipdown__theme-dark .rotor-group:nth-child(n+2):nth-child(-n+3):before,
    .flipdown.flipdown__theme-dark .rotor-group:nth-child(n+2):nth-child(-n+3):after {
        background-color: #151515;
    }

    /* Rotor tops */
    .flipdown.flipdown__theme-dark .rotor,
    .flipdown.flipdown__theme-dark .rotor-top,
    .flipdown.flipdown__theme-dark .rotor-leaf-front {
        color: #FFFFFF;
        background-color: #151515;
    }

    /* Rotor bottoms */
    .flipdown.flipdown__theme-dark .rotor-bottom,
    .flipdown.flipdown__theme-dark .rotor-leaf-rear {
        color: #EFEFEF;
        background-color: #202020;
    }

    /* Hinge */
    .flipdown.flipdown__theme-dark .rotor:after {
        border-top: solid 1px #151515;
    }

    /********** Theme: light **********/
    /* Font styles */
    .flipdown.flipdown__theme-light {
        font-family: sans-serif;
        font-weight: bold;
    }

    /* Rotor group headings */
    .flipdown.flipdown__theme-light .rotor-group-heading:before {
        color: #EEEEEE;
    }

    /* Delimeters */
    .flipdown.flipdown__theme-light .rotor-group:nth-child(n+2):nth-child(-n+3):before,
    .flipdown.flipdown__theme-light .rotor-group:nth-child(n+2):nth-child(-n+3):after {
        background-color: #DDDDDD;
    }

    /* Rotor tops */
    .flipdown.flipdown__theme-light .rotor,
    .flipdown.flipdown__theme-light .rotor-top,
    .flipdown.flipdown__theme-light .rotor-leaf-front {
        color: #222222;
        background-color: #DDDDDD;
    }

    /* Rotor bottoms */
    .flipdown.flipdown__theme-light .rotor-bottom,
    .flipdown.flipdown__theme-light .rotor-leaf-rear {
        color: #333333;
        background-color: #EEEEEE;
    }

    /* Hinge */
    .flipdown.flipdown__theme-light .rotor:after {
        border-top: solid 1px #222222;
    }

    /* END OF THEMES */

    .flipdown {
        overflow: visible;
        width: 510px;
        height: 110px;
    }

    .flipdown .rotor-group {
        position: relative;
        float: left;
        padding-right: 30px;
    }

    .flipdown .rotor-group:last-child {
        padding-right: 0;
    }

    .flipdown .rotor-group-heading:before {
        display: block;
        height: 30px;
        line-height: 30px;
        text-align: center;
    }

    .flipdown .rotor-group:nth-child(1) .rotor-group-heading:before {
        content: attr(data-before);
    }

    .flipdown .rotor-group:nth-child(2) .rotor-group-heading:before {
        content: attr(data-before);
    }

    .flipdown .rotor-group:nth-child(3) .rotor-group-heading:before {
        content: attr(data-before);
    }

    .flipdown .rotor-group:nth-child(4) .rotor-group-heading:before {
        content: attr(data-before);
    }

    .flipdown .rotor-group:nth-child(n+2):nth-child(-n+3):before {
        content: '';
        position: absolute;
        bottom: 20px;
        left: 115px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .flipdown .rotor-group:nth-child(n+2):nth-child(-n+3):after {
        content: '';
        position: absolute;
        bottom: 50px;
        left: 115px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .flipdown .rotor {
        position: relative;
        float: left;
        width: 50px;
        height: 80px;
        margin: 0px 5px 0px 0px;
        border-radius: 4px;
        font-size: 4rem;
        text-align: center;
        perspective: 200px;
    }

    .flipdown .rotor:last-child {
        margin-right: 0;
    }

    .flipdown .rotor-top,
    .flipdown .rotor-bottom {
        overflow: hidden;
        position: absolute;
        width: 50px;
        height: 40px;
    }

    .flipdown .rotor-leaf {
        z-index: 1;
        position: absolute;
        width: 50px;
        height: 80px;
        transform-style: preserve-3d;
        transition: transform 0s;
    }

    .flipdown .rotor-leaf.flipped {
        transform: rotateX(-180deg);
        transition: all 0.5s ease-in-out;
    }

    .flipdown .rotor-leaf-front,
    .flipdown .rotor-leaf-rear {
        overflow: hidden;
        position: absolute;
        width: 50px;
        height: 40px;
        margin: 0;
        transform: rotateX(0deg);
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
    }

    .flipdown .rotor-leaf-front {
        line-height: 80px;
        border-radius: 4px 4px 0px 0px;
    }

    .flipdown .rotor-leaf-rear {
        line-height: 0px;
        border-radius: 0px 0px 4px 4px;
        transform: rotateX(-180deg);
    }

    .flipdown .rotor-top {
        line-height: 80px;
        border-radius: 4px 4px 0px 0px;
    }

    .flipdown .rotor-bottom {
        bottom: 0;
        line-height: 0px;
        border-radius: 0px 0px 4px 4px;
    }

    .flipdown .rotor:after {
        content: '';
        z-index: 2;
        position: absolute;
        bottom: 0px;
        left: 0px;
        width: 50px;
        height: 40px;
        border-radius: 0px 0px 4px 4px;
    }

    @media (max-width: 550px) {

        .flipdown {
            width: 312px;
            height: 70px;
        }

        .flipdown .rotor {
            font-size: 2.2rem;
            margin-right: 3px;
        }

        .flipdown .rotor,
        .flipdown .rotor-leaf,
        .flipdown .rotor-leaf-front,
        .flipdown .rotor-leaf-rear,
        .flipdown .rotor-top,
        .flipdown .rotor-bottom,
        .flipdown .rotor:after {
            width: 30px;
        }

        .flipdown .rotor-group {
            padding-right: 20px;
        }

        .flipdown .rotor-group:last-child {
            padding-right: 0px;
        }

        .flipdown .rotor-group-heading:before {
            font-size: 0.8rem;
            height: 20px;
            line-height: 20px;
        }

        .flipdown .rotor-group:nth-child(n+2):nth-child(-n+3):before,
        .flipdown .rotor-group:nth-child(n+2):nth-child(-n+3):after {
            left: 69px;
        }

        .flipdown .rotor-group:nth-child(n+2):nth-child(-n+3):before {
            bottom: 13px;
            height: 8px;
            width: 8px;
        }

        .flipdown .rotor-group:nth-child(n+2):nth-child(-n+3):after {
            bottom: 29px;
            height: 8px;
            width: 8px;
        }

        .flipdown .rotor-leaf-front,
        .flipdown .rotor-top {
            line-height: 50px;
        }

        .flipdown .rotor-leaf,
        .flipdown .rotor {
            height: 50px;
        }

        .flipdown .rotor-leaf-front,
        .flipdown .rotor-leaf-rear,
        .flipdown .rotor-top,
        .flipdown .rotor-bottom,
        .flipdown .rotor:after {
            height: 25px;
        }
    }

    body {
        font-size: 150%;
        height: 100vh;
        background: #000;
        background-image: linear-gradient(to left top,
                #ba4141,
                #b73a39,
                #b33230,
                #b02a28,
                #ac211f,
                #a51c1a,
                #9f1616,
                #981011,
                #8e0e0f,
                #830c0d,
                #790a0b,
                #6f0808);
    }

    /* christmas tree*/

    .tree-container {
        position: relative;
        width: 300px;
        height: 475px;
        margin: auto;
        z-index: -2;
        overflow: hidden;
    }

    .tree {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 5%;
    }

    .star {
        position: absolute;
        width: 100px;
        height: 100px;
        background: #a18006;
        clip-path: polygon(50% 0%,
                61% 35%,
                98% 35%,
                68% 57%,
                79% 91%,
                50% 70%,
                21% 91%,
                32% 57%,
                2% 35%,
                39% 35%);
        left: 95px;
        z-index: 4;
        filter: drop-shadow(0.75em 0.75em 0.5em);
    }

    .cone {
        width: 150px;
        height: 100px;
        border-radius: 45%;
        background: radial-gradient(farthest-side at top, #026e46, #024e32);
        -webkit-mask: conic-gradient(from 150deg at top,
                #0000,
                #000 1deg 60deg,
                #0000 61deg);
    }

    .tree-cone1 {
        position: absolute;
        top: 50px;
        width: 200px;
        height: 180px;
        left: 45px;
        z-index: 3;
    }

    .tree-cone2 {
        position: absolute;
        top: 75px;
        width: 240px;
        height: 220px;
        left: 25px;
        z-index: 2;
    }

    .tree-cone3 {
        position: absolute;
        top: 115px;
        width: 260px;
        height: 240px;
        left: 15px;
    }

    .trunk {
        position: absolute;
        top: 310px;
        width: 75px;
        height: 75px;
        background: radial-gradient(farthest-side at top, #4e2402, #351801);
        z-index: -1;
        left: 105px;
    }

    /* ornaments */
    .ornament {
        position: absolute;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        box-shadow: 0 0 3px #033b26;
        z-index: 4;
    }

    .shine {
        position: absolute;
        width: 55%;
        height: 55%;
        top: 10%;
        right: 11%;
        border-radius: 50%;
        background: white;
        filter: opacity(60%);
    }

    .or1 {
        left: 28%;
        top: 34%;
        background: #0742d9;
    }

    .or2 {
        left: 60%;
        top: 40%;
        background: #c91212;
    }

    .or3 {
        left: 20%;
        top: 49%;
        background: #dbb700;
    }

    .or4 {
        left: 48%;
        top: 55%;
        background: #0742d9;
    }

    .or5 {
        left: 70%;
        top: 65%;
        background: #dbb700;
    }

    .or6 {
        left: 25%;
        top: 63%;
        background: #c91212;
    }

    .bells-container {
        position: relative;
        left: 80px;
        top: 65px;
    }

    .bell1,
    .bell2 {
        width: 30px;
        height: 0;
        border-bottom: 35px solid #d4a429;
        border-right: 6px solid transparent;
        border-left: 6px solid transparent;
        z-index: 11;
    }

    .bell1 {
        position: relative;
        top: 50px;
        left: 50px;
        transform: rotate(25deg);
    }

    .bell2 {
        position: relative;
        top: 15px;
        left: 90px;
        transform: rotate(-25deg);
    }

    .bell-top {
        width: 30px;
        height: 15px;
        background-color: #d4a429;
        position: relative;
        bottom: 13px;
        border-radius: 15px 15px 0 0;
    }

    .bell-bottom {
        width: 41px;
        height: 0;
        border-bottom: 10px solid #d4a445;
        border-right: 6px solid transparent;
        border-left: 6px solid transparent;
        position: relative;
        top: 19px;
        right: 11px;
        border-radius: 0 0 7.5px 7.5px;
    }

    .bell-mid {
        background-color: #d4a429;
        height: 7.5px;
        width: 15px;
        position: relative;
        top: 18.5px;
        border-radius: 0 0 7.5px 7.5px;
    }

    .bow {
        position: relative;
        left: 68px;
        bottom: 45px;
        transform: rotate(-5deg);
        z-index: 12;
    }

    .b1 {
        height: 12.5px;
        width: 0;
        border-right: 20px solid #e95840;
        border-top: 7.5px solid transparent;
        border-bottom: 7.5px solid transparent;
        position: relative;
        bottom: 8.5px;
        left: 30px;
    }

    .b2 {
        height: 12.5px;
        width: 0;
        border-left: 20px solid #e95840;
        border-top: 7.5px solid transparent;
        border-bottom: 7.5px solid transparent;
        position: relative;
        bottom: 36px;
        left: 0px;
    }

    .b3 {
        background-color: #e4391b;
        height: 20px;
        width: 17.5px;
        border-radius: 7.5px;
        position: relative;
        bottom: 60px;
        left: 16px;
    }

    .shadow {
        background-color: rgba(0, 0, 0, 0.07);
        position: absolute;
        width: 270px;
        height: 40px;
        border-radius: 50%;
        top: 390px;
        left: 10px;
        z-index: -1;
    }

    /* gifts*/
    .gift {
        position: absolute;
        width: 60px;
        height: 50px;
        background-color: #ffc857;
        top: 365px;
        left: 30px;
        box-shadow: inset -8px 0 0 rgba(0, 0, 0, 0.07);
    }

    .gift:before {
        content: "";
        position: absolute;
        width: 70px;
        height: 20px;
        left: -5px;
        background-color: #ffc857;
        box-shadow: inset -8px -4px 0 rgba(0, 0, 0, 0.07);
    }

    .gift:after {
        content: "";
        background-color: #db3a34;
        width: 10px;
        height: 50px;
        position: absolute;
        left: 25px;
    }

    .ribbon {
        position: absolute;
        width: 20px;
        height: 10px;
        border: 3px solid #db3a34;
        border-radius: 50%;
        transform: skew(15deg, 15deg);
        top: 350px;
        left: 35px;
    }

    .ribbon:before {
        content: "";
        position: absolute;
        width: 20px;
        height: 10px;
        border: 3px solid #db3a34;
        border-radius: 50%;
        transform: skew(-15deg, -20deg);
        left: 22px;
        top: -8px;
    }

    .gift2 {
        position: absolute;
        width: 50px;
        height: 40px;
        background-color: #08bdbd;
        top: 380px;
        left: 150px;
        box-shadow: inset -8px 0 0 rgba(0, 0, 0, 0.07);
    }

    .gift2:before {
        content: "";
        position: absolute;
        width: 60px;
        height: 15px;
        background-color: #08bdbd;
        left: -5px;
        box-shadow: inset -8px -4px 0 rgba(0, 0, 0, 0.07);
    }

    .gift2:after {
        content: "";
        background-color: #abff4f;
        width: 10px;
        height: 40px;
        position: absolute;
        left: 20px;
    }

    .ribbon2 {
        position: absolute;
        width: 15px;
        height: 7px;
        border: 3px solid #abff4f;
        border-radius: 50%;
        transform: skew(15deg, 15deg);
        top: 370px;
        left: 155px;
    }

    .ribbon2:before {
        content: "";
        position: absolute;
        width: 15px;
        height: 7px;
        border: 3px solid #abff4f;
        border-radius: 50%;
        transform: skew(-15deg, -20deg);
        left: 15px;
        top: -8px;
    }

    /* title */

    h1 {
        font-family: "Berkshire Swash";
        font-weight: normal;
        color: green;
        padding-top: 5%;
        text-align: center;
        text-shadow: 10px 10px 5px black;
        animation-name: move;
        animation-iteration-count: infinite;
        animation-duration: 4s;
    }

    @keyframes move {
        0% {
            transform: translate3d(0, 0, 0);
        }

        50% {
            transform: translate3d(0, 0.75em, 0);
        }

        100% {
            transform: translate3d(0, 0, 0);
        }
    }

    /* top light rope*/
    .lightrope {
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        position: fixed;
        z-index: 1;
        margin: -15px 0 0 0;
        padding: 0;
        pointer-events: none;
        width: 100%;
    }

    .lightrope li {
        position: relative;
        animation-fill-mode: both;
        animation-iteration-count: infinite;
        list-style: none;
        margin: 0;
        padding: 0;
        display: block;
        width: 12px;
        height: 28px;
        border-radius: 50%;
        margin: 20px;
        display: inline-block;
        background: rgba(0, 247, 165, 1);
        box-shadow: 0px 4.6666666667px 24px 3px rgba(0, 247, 165, 1);
        animation-name: flash-1;
        animation-duration: 2s;
    }

    .lightrope li:nth-child(2n + 1) {
        background: rgba(0, 255, 255, 1);
        box-shadow: 0px 4.6666666667px 24px 3px rgba(0, 255, 255, 0.5);
        animation-name: flash-2;
        animation-duration: 0.4s;
    }

    .lightrope li:nth-child(4n + 2) {
        background: rgba(247, 0, 148, 1);
        box-shadow: 0px 4.6666666667px 24px 3px rgba(247, 0, 148, 1);
        animation-name: flash-3;
        animation-duration: 1.1s;
    }

    .lightrope li:nth-child(odd) {
        animation-duration: 1.8s;
    }

    .lightrope li:nth-child(3n + 1) {
        animation-duration: 1.4s;
    }

    .lightrope li:before {
        content: "";
        position: absolute;
        background: #222;
        width: 10px;
        height: 9.3333333333px;
        border-radius: 3px;
        top: -4.6666666667px;
        left: 1px;
    }

    .lightrope li:after {
        content: "";
        top: -14px;
        left: 9px;
        position: absolute;
        width: 52px;
        height: 18.6666666667px;
        border-bottom: solid #222 2px;
        border-radius: 50%;
    }

    .lightrope li:last-child:after {
        content: none;
    }

    .lightrope li:first-child {
        margin-left: -40px;
    }

    @keyframes flash-1 {

        0%,
        100% {
            background: rgba(0, 247, 165, 1);
            box-shadow: 0px 4.6666666667px 24px 3px rgba(0, 247, 165, 1);
        }

        50% {
            background: rgba(0, 247, 165, 0.4);
            box-shadow: 0px 4.6666666667px 24px 3px rgba(0, 247, 165, 0.2);
        }
    }

    @keyframes flash-2 {

        0%,
        100% {
            background: rgba(0, 255, 255, 1);
            box-shadow: 0px 4.6666666667px 24px 3px rgba(0, 255, 255, 1);
        }

        50% {
            background: rgba(0, 255, 255, 0.4);
            box-shadow: 0px 4.6666666667px 24px 3px rgba(0, 255, 255, 0.2);
        }
    }

    @keyframes flash-3 {

        0%,
        100% {
            background: rgba(247, 0, 148, 1);
            box-shadow: 0px 4.6666666667px 24px 3px rgba(247, 0, 148, 1);
        }

        50% {
            background: rgba(247, 0, 148, 0.4);
            box-shadow: 0px 4.6666666667px 24px 3px rgba(247, 0, 148, 0.2);
        }
    }

    /* snowflakes*/

    @-webkit-keyframes snowflakes-fall {
        0% {
            top: -10%;
        }

        100% {
            top: 100%;
        }
    }

    @-webkit-keyframes snowflakes-shake {
        0% {
            transform: translateX(0px);
        }

        50% {
            transform: translateX(80px);
        }

        100% {
            transform: translateX(0px);
        }
    }

    .snowflake {
        position: fixed;
        top: -10%;
        z-index: 10;
        color: #fff;
        text-shadow: 0 0 1px #000;
        font-size: 1em;
        user-select: none;
        cursor: default;
        animation-name: snowflakes-fall, snowflakes-shake;
        animation-duration: 10s, 3s;
        animation-timing-function: linear, ease-in-out;
        animation-iteration-count: infinite, infinite;
        animation-play-state: running, running;
    }

    .snowflake:nth-of-type(0) {
        left: 1%;
        animation-delay: 0s, 0s;
    }

    .snowflake:nth-of-type(1) {
        left: 10%;
        animation-delay: 1s, 1s;
    }

    .snowflake:nth-of-type(2) {
        left: 20%;
        animation-delay: 2s, 2s;
    }

    .snowflake:nth-of-type(3) {
        left: 30%;
        animation-delay: 4s, 2s;
    }

    .snowflake:nth-of-type(4) {
        left: 40%;
        animation-delay: 2s, 2s;
    }

    .snowflake:nth-of-type(5) {
        left: 50%;
        animation-delay: 8s, 3s;
    }

    .snowflake:nth-of-type(6) {
        left: 60%;
        animation-delay: 6s, 2s;
    }

    .snowflake:nth-of-type(7) {
        left: 70%;
        animation-delay: 2.5s, 1s;
    }

    .snowflake:nth-of-type(8) {
        left: 80%;
        animation-delay: 1s, 0s;
    }

    .snowflake:nth-of-type(9) {
        left: 80%;
        animation-delay: 3s, 1.5s;
    }

    .flipdown {
        margin: 0 auto;
    }

    /* Flying santa*/
    .santa-container {
        height: 480px;
        width: 350px;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        position: absolute;
        animation-duration: 10s;
        animation-iteration-count: infinite;
        animation-name: plane-movement;
    }

    @keyframes plane-movement {
        0% {
            opacity: 1;
            left: 100vw;
            top: 20%;
        }

        50% {
            opacity: 1;
            left: 50vw;
            top: 40%;
        }

        100% {
            opacity: 1;
            left: -100vw;
            top: 20%;
        }
    }

    svg {
        position: absolute;
        top: 0;
        left: 0;
    }

    .plane {
        position: relative;
        -webkit-animation: float 3s infinite;
        animation: float 3s infinite;
    }

    @-webkit-keyframes float {
        50% {
            -webkit-transform: translateY(25px);
            transform: translateY(25px);
        }
    }

    @keyframes float {
        50% {
            -webkit-transform: translateY(25px);
            transform: translateY(25px);
        }
    }

    .hand {
        -webkit-transform: rotate(10deg);
        -ms-transform: rotate(10deg);
        transform: rotate(10deg);
        -webkit-animation: wave 1.5s infinite;
        animation: wave 1.5s infinite;
        -webkit-transform-origin: center;
        -ms-transform-origin: center;
        transform-origin: center;
    }

    .blade {
        -webkit-animation: spin 1s infinite linear;
        animation: spin 1s infinite linear;
        -webkit-transform-origin: 50% 54%;
        -ms-transform-origin: 50% 54%;
        transform-origin: 50% 54%;
    }

    @-webkit-keyframes spin {
        100% {
            -webkit-transform: rotateX(360deg);
            transform: rotateX(360deg);
        }
    }

    @keyframes spin {
        100% {
            -webkit-transform: rotateX(360deg);
            transform: rotateX(360deg);
        }
    }

    @-webkit-keyframes wave {
        50% {
            -webkit-transform: rotate(-10deg);
            transform: rotate(-10deg);
        }
    }

    @keyframes wave {
        50% {
            -webkit-transform: rotate(-10deg);
            transform: rotate(-10deg);
        }
    }

    @media screen and (min-width: 451px) {
        a {
            font-size: 20px;
            padding: 8px 12px 8px 12px;
        }
    }

    @media screen and (max-width: 450px) {
        a {
            font-size: 14px;
            padding: 5px 8px 5px 8px;
        }
    }

    /* Reindeer */
    .deer-container {
        background-color: transparent;
        border-radius: 4px;
        box-shadow: 0 1px 3px transparent;
        height: 300px;
        width: 200px;
        margin: 40px auto 50px auto;
        position: relative;
        bottom: 430px;
        right: 190px;
    }

    .artboard {
        height: 100%;
        overflow: hidden;
        position: relative;
        width: 100%;
    }

    .deer {
        width: 50px;
        margin: 0 auto;
        position: relative;
    }

    .rocking {
        animation: rocking 0.4s ease-in-out infinite alternate-reverse;
        transform-origin: bottom left;
        position: relative;
        z-index: 1;
    }

    @keyframes rocking {
        100% {
            transform: rotate(-1deg);
        }
    }

    .head {
        position: relative;
        width: 50px;
    }

    .horns {
        animation: rocking 0.4s cubic-bezier(0.4, 0, 0.2, 1) infinite alternate-reverse;
        height: 55px;
        position: relative;
        top: 31px;
        width: 50px;
    }

    .horn {
        background-color: #91655d;
        border-radius: 7px 7px 0 0;
        height: 55px;
        position: relative;
        width: 7px;
        z-index: 1;
    }

    .horn .line {
        background-color: #91655d;
        border-radius: 7px 7px 7px 7px;
        height: 7px;
        width: 20px;
        margin-bottom: 15px;
        position: relative;
        top: 10px;
    }

    .horn-left {
        top: -7px;
        transform: rotate(-25deg);
    }

    .horn-left .line-one {
        right: 12px;
        transform: rotate(30deg);
    }

    .horn-left .line-two {
        top: -2px;
        left: 2px;
        transform: rotate(-30deg);
    }

    .horn-left .line-three {
        top: -15px;
        right: 12px;
        transform: rotate(30deg);
    }

    .horn-right {
        bottom: 60px;
        left: 40px;
        transform: rotate(25deg);
    }

    .horn-right .line-one {
        top: 7px;
        right: 1px;
        transform: rotate(-30deg);
    }

    .horn-right .line-two {
        top: -2px;
        right: 12px;
        transform: rotate(30deg);
    }

    .horn-right .line-three {
        top: -15px;
        left: 0px;
        transform: rotate(-30deg);
    }

    .ears {
        position: absolute;
        top: 70px;
    }

    .ear {
        background-color: #91655d;
        border-radius: 100% 50% 50% 50%;
        height: 18px;
        position: relative;
        right: 20px;
        top: 10px;
        transform: rotate(30deg);
        transform-origin: 100%;
        width: 30px;
    }

    .ear:before {
        background-color: #e7beb2;
        border-radius: 100% 50% 50% 50%;
        height: 9px;
        content: "";
        display: block;
        left: 5px;
        position: relative;
        top: 5px;
        width: 15px;
    }

    .ear-left {
        animation: ear-left 2s cubic-bezier(0.6, -0.28, 0.74, 0.05) infinite alternate-reverse;
        transform: rotate(30deg);
        position: relative;
        right: 20px;
        top: 10px;
    }

    @keyframes ear-left {
        85% {
            transform: rotate(30deg);
        }

        100% {
            transform: rotate(-10deg);
        }
    }

    .ear-right {
        animation: ear-right 2s cubic-bezier(0.6, -0.28, 0.74, 0.05) 2s infinite alternate-reverse;
        left: 10px;
        right: 0;
        top: -8px;
        transform: rotate(160deg);
    }

    @keyframes ear-right {
        85% {
            transform: rotate(160deg);
        }

        100% {
            transform: rotate(170deg);
        }
    }

    .eyes {
        position: absolute;
        top: 90px;
        right: -5px;
        width: 32px;
        z-index: 2;
    }

    .eyes .eye {
        background: linear-gradient(0deg, white 50%, #aa8275 50%);
        border-radius: 15px;
        height: 15px;
        width: 15px;
    }

    .eyes .eye-left {
        float: left;
    }

    .eyes .eye:after {
        animation: eyes 5s infinite alternate-reverse;
        background-color: #495169;
        border-radius: 5px;
        height: 5px;
        content: "";
        display: block;
        left: 5px;
        position: relative;
        top: -3px;
        width: 5px;
    }

    @keyframes eyes {
        0% {
            transform: translate(3px, 2px);
        }

        75% {
            transform: translate(3px, 2px);
        }
    }

    .eyes .eye:before {
        animation: eaves 5s infinite alternate-reverse;
        background-color: #aa8275;
        border-radius: 9px 9px 0 0;
        height: 9px;
        content: "";
        display: block;
        position: relative;
        z-index: 1;
    }

    @keyframes eaves {
        0% {
            top: -1px;
        }
    }

    .eyes .eye-right {
        float: right;
    }

    .nose {
        background-color: #91655d;
        border-radius: 0 7px 15px;
        top: 47px;
        height: 18px;
        left: 40px;
        position: relative;
        width: 20px;
        z-index: 2;
    }

    .nose:before {
        background-color: #fb5d5d;
        border-radius: 15px;
        content: "";
        display: block;
        height: 14px;
        position: absolute;
        right: -0.5px;
        top: -0.5px;
        width: 16px;
    }

    .nose:after {
        background-color: white;
        border-radius: 5px;
        content: "";
        display: block;
        height: 2px;
        position: absolute;
        right: 4px;
        top: 2px;
        width: 5px;
    }

    .body {
        font-family: 'Varela Round', serif;
        background-color: #91655d;
        border-radius: 50px 50px 0;
        box-shadow: inset 7px 0 0 0 #9c7169;
        height: 140px;
        position: relative;
        width: 50px;
        z-index: 1;
    }

    .body:before {
        background-color: #e7beb2;
        border-radius: 20px 0 0 20px;
        bottom: 20px;
        box-shadow: inset -7px 0 0 0 #c39e9a;
        content: "";
        display: block;
        height: 65px;
        position: absolute;
        right: 0;
        width: 20px;
    }

    .hooves {
        position: relative;
        bottom: 40px;
        right: 34px;
    }

    .hoof-one {
        animation: jump 0.3s ease-in-out infinite alternate-reverse;
        left: 10px;
        position: relative;
        top: 70px;
        transform: rotate(25deg);
        transform-origin: 100% 50%;
    }

    @keyframes jump {
        100% {
            transform: translateY(-2px) rotate(25deg);
        }
    }

    .hoof-one .line {
        height: 30px;
        border: 20px solid;
        border-radius: 40px;
        border-color: transparent transparent #91655d transparent;
        left: 25px;
        width: 30px;
        position: relative;
        top: 5px;
        transform: rotate(-30deg);
    }

    .hoof-one .anim-part {
        position: relative;
        bottom: 23px;
        left: 81px;
        transform: rotate(-75deg);
        transform-origin: left;
    }

    .hoof-one .circle {
        animation: hoof-one 0.3s ease-in-out infinite alternate-reverse;
        background-color: #91655d;
        height: 20px;
        width: 20px;
        border-radius: 30px;
        transform: translateX(3px) rotate(0deg);
    }

    @keyframes hoof-one {
        100% {
            transform: translateX(2px) rotate(5deg);
        }
    }

    .hoof-one .circle-last {
        border-radius: 20px 0 0 20px;
        transform: translateX(2px) rotate(0deg);
    }

    .hoof-one .circle-last:before {
        content: "";
        display: block;
        border-top: 20px solid #674a4a;
        border-left: 7px solid transparent;
        height: 0;
        left: 10px;
        width: 7px;
        position: relative;
        z-index: 1;
    }

    .hoof-one .circle-last:after {
        background-color: #ffb63c;
        border-radius: 10px;
        bottom: 30px;
        content: "";
        display: block;
        height: 40px;
        left: 19px;
        position: relative;
        width: 9px;
    }

    .hoof-two {
        animation: jump-two 0.3s ease-in-out infinite alternate-reverse;
        left: 55px;
        position: relative;
        top: 10px;
        z-index: -1;
    }

    @keyframes jump-two {
        100% {
            transform: translateY(2px);
        }
    }

    .hoof-two .line-one {
        transform: rotate(-45deg);
        height: 10px;
        border: 20px solid;
        border-radius: 40px;
        border-color: transparent transparent #91655d transparent;
        width: 10px;
        position: absolute;
    }

    .hoof-two .line-two {
        left: 30px;
        transform: rotate(135deg);
        height: 10px;
        border: 20px solid;
        border-radius: 40px;
        border-color: transparent transparent #91655d transparent;
        width: 10px;
        position: absolute;
    }

    .tail {
        background-color: #9c7169;
        bottom: 0;
        left: 4px;
        position: absolute;
        width: 20px;
        z-index: 0;
    }

    @keyframes tail {
        10% {
            transform: rotate(2deg);
        }

        20% {
            transform: rotate(-5deg);
        }
    }

    .tail .circle {
        -webkit-animation: tail 2s cubic-bezier(0, 0.02, 0.9, 2) infinite;
        animation: tail 2s cubic-bezier(0, 0.02, 0.9, 2) infinite;
        background-color: #9c7169;
        border-radius: 11px;
        height: 12px;
        position: relative;
        right: 2px;
        transform: rotate(-5deg);
        width: 12px;
    }

    .legs {
        position: relative;
    }

    .legs:before {
        background: linear-gradient(to left, #91655d 50%, #9c7169 50%);
        bottom: 0;
        content: "";
        display: block;
        height: 10px;
        left: 7px;
        position: absolute;
        width: 30px;
        z-index: 0;
    }

    .leg-left .anim-part:before,
    .leg-left .anim-part:after {
        content: "";
        display: block;
        position: absolute;
        z-index: 1;
    }

    .leg-left:before,
    .leg-left:after,
    .leg-right:before,
    .leg-right:after {
        content: "";
        display: block;
        position: absolute;
        z-index: 1;
    }

    .leg-left:after {
        background-color: #674a4a;
        height: 13px;
        left: 48px;
        top: 32px;
        transform: skew(-8deg);
        width: 20px;
        z-index: 2;
    }

    .leg-left .anim-part {
        animation: leg-left 0.4s ease-out infinite alternate-reverse;
        position: relative;
        top: 1px;
        transform: rotate(5deg) translateX(3px);
        transform-origin: right;
        z-index: 2;
    }

    @keyframes leg-left {
        0% {
            transform: rotate(0deg) translateX(0px);
        }

        50% {
            transform: rotate(5deg) translateX(3px);
        }
    }

    .leg-left .anim-part:before {
        height: 16px;
        width: 16px;
        border: 20px solid;
        border-radius: 30px;
        border-color: transparent #835f5b transparent transparent;
        transform: rotate(-45deg);
        top: -17px;
        left: 17px;
    }

    .leg-left .anim-part .line {
        background-color: #835f5b;
        height: 25px;
        position: absolute;
        width: 20px;
        left: 51px;
        top: 7px;
        z-index: 2;
        transform: skew(-9deg);
    }

    .leg-left .anim-part:after {
        background-color: #835f5b;
        height: 20px;
        left: 33px;
        top: -20px;
        width: 24px;
    }

    .leg-left:after {
        background-color: #674a4a;
        height: 13px;
        left: 48px;
        top: 32px;
        transform: skew(-8deg);
        width: 20px;
        z-index: 2;
    }

    .leg-right {
        position: relative;
        right: 10px;
    }

    .leg-right:before {
        height: 30px;
        width: 38px;
        border: 20px solid;
        border-radius: 40px;
        border-color: #91655d transparent transparent transparent;
        transform: rotate(-15deg);
        z-index: 3;
        top: -29px;
        left: 21px;
    }

    .leg-right .anim-part {
        position: absolute;
        left: 64px;
        bottom: 9px;
        transform: rotate(43deg);
        z-index: 2;
    }

    .leg-right .anim-part .circle {
        animation: leg-right 0.4s ease-out infinite alternate-reverse;
        width: 20px;
        height: 20px;
        background-color: #91655d;
        border-radius: 20px;
        transform: translateX(4px) rotate(4deg);
    }

    @keyframes leg-right {
        100% {
            transform: translateX(4px) rotate(2deg);
        }
    }

    .leg-right .anim-part .circle-last {
        border-radius: 20px 0 0 20px;
    }

    .leg-right .anim-part .circle-last:before {
        content: "";
        display: block;
        border-bottom: 20px solid #674a4a;
        border-right: 2px solid transparent;
        height: 0;
        left: 15px;
        width: 11px;
        position: relative;
        z-index: 1;
    }

    .presents {
        top: 3px;
        height: 45px;
        margin: 0 auto;
        position: relative;
        width: 110px;
    }

    .presents:after {
        animation: shadow 0.4s ease-out infinite alternate-reverse;
        background-color: rgba(0, 0, 0, 0.07);
        bottom: 0;
        border-radius: 7px;
        content: "";
        display: block;
        height: 7px;
        left: -22px;
        position: absolute;
        width: 170px;
    }

    .present {
        border-radius: 4px;
        bottom: 3px;
        position: absolute;
        z-index: 1;
    }

    .present:before,
    .present:after {
        content: "";
        display: block;
        position: relative;
    }

    .present-one {
        background-color: #fb5d5d;
        height: 45px;
        right: 32px;
        width: 45px;
        z-index: 3;
    }

    .present-one:before {
        background-color: #fc7676;
        height: 12px;
        width: 47px;
        border-radius: 4px 4px 2px 2px;
        box-shadow: 0 2px 0 0 rgb(0 0 0 / 4%);
        right: 1px;
    }

    .present-two {
        background-color: #82dfe3;
        height: 30px;
        width: 30px;
    }

    .present-two:before {
        background-color: #97e4e8;
        height: 10px;
        width: 32px;
    }

    .present:before {
        border-radius: 4px 4px 2px 2px;
        box-shadow: 0 2px 0 0 rgb(0 0 0 / 4%);
        right: 1px;
    }

    .present-two:after {
        background-color: #69b2cb;
        bottom: 10px;
        height: 100%;
        left: 7px;
        width: 5px;
    }

    .present-two-right {
        right: 5px;
    }

    .present-two {
        background-color: #82dfe3;
        height: 30px;
        width: 30px;
    }

    .present-three {
        background-color: #ffb63c;
        height: 25px;
        left: 25px;
        margin: auto;
        width: 25px;
        z-index: 3;
    }

    .present-three:before {
        background-color: #ffc056;
        height: 8px;
        width: 27px;
    }

    .present:before {
        border-radius: 4px 4px 2px 2px;
        box-shadow: 0 2px 0 0 rgb(0 0 0 / 4%);
        right: 1px;
    }

    .present:before,
    .present:after {
        content: "";
        display: block;
        position: relative;
    }

    .present-three:after {
        background-color: #fb5353;
        bottom: 8px;
        height: 100%;
        left: 13px;
        width: 5px;
    }

    .present:before,
    .present:after {
        content: "";
        display: block;
        position: relative;
    }

    .present-three:after {
        background-color: #fb5353;
        bottom: 8px;
        height: 100%;
        left: 13px;
        width: 5px;
    }

    .present:before,
    .present:after {
        content: "";
        display: block;
        position: relative;
    }
   /* CSS สำหรับพื้นหลังและจุดศูนย์กลาง (Prompt Screen) */
/* CSS สำหรับพื้นหลังมืดของจอ Prompt */
/* CSS สำหรับพื้นหลังมืดของจอ Prompt */
#play-prompt {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* พื้นหลังมืดและมีเกล็ดหิมะเล็กน้อย */
    background-color: #0d0d0d;
    background-image: radial-gradient(#222, #0d0d0d 80%);
    display: flex; 
    justify-content: center; 
    align-items: center; 
    z-index: 10000;
    font-family: 'Sriracha', cursive; /* ใช้ฟอนต์ที่ดูเขียนด้วยลายมือ */
}

/* ✉️ CSS สำหรับตัว "จดหมาย" (Letter/Envelope) ✉️ */
#card-content {
    /* สีพื้นหลังเหมือนกระดาษเก่า */
    background-color: #f7f7e9; 
    color: #333333;
    padding: 70px 50px; /* เพิ่ม Padding ให้ดูเหมือนซองจดหมาย */
    border-radius: 5px; /* มุมแหลมกว่าการ์ด */
    text-align: center;
    max-width: 450px;
    min-width: 300px;
    position: relative; /* สำคัญสำหรับการวางครั่ง */
    
    /* การหมุนและการยกขึ้นเล็กน้อย (เหมือนจดหมายวางอยู่บนพื้น) */
    transform: rotate(-2deg) translateY(0); 
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), /* เงาที่ดูมีมิติ */
                0 0 0 5px #024e32; /* ขอบเขียวเล็กน้อย */
    
    /* สร้างรอยพับซองจดหมายด้วย Border */
    border-top: 25px solid #e4391b; /* จำลองขอบซองด้านบน (สีแดง) */
    
    animation: bounceIn 1.5s cubic-bezier(0.175, 0.885, 0.32, 1.27) forwards;
}

/* 🔴 จำลอง "ครั่งผนึก" (Wax Seal) */
#card-content::after {
    content: '';
    position: absolute;
    top: -10px; /* เลื่อนให้อยู่บนรอยพับสีแดง */
    left: calc(50% - 15px);
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: radial-gradient(circle at 50% 50%, #b02a28 0%, #902020 100%); /* Gradient ครั่ง */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5) inset, 0 5px 10px rgba(0, 0, 0, 0.3);
    z-index: 10;
    transform: rotate(5deg);
    /* เพิ่มตัวอักษรบนครั่ง (ใช้ Icon/Text) */
    /* ถ้าต้องการใส่ตัวอักษร: content: 'S'; font-family: sans-serif; color: #fff; line-height: 30px; font-size: 18px; */
}


/* 🎁 CSS สำหรับปุ่ม "เปิดจดหมาย" (Button) 🎁 */
#force-play-button {
    padding: 12px 30px; /* ทำให้ปุ่มดูเป็นระเบียบ */
    font-size: 18px;
    cursor: pointer;
    background-color: #333333; /* สีเข้มเพื่อเน้น */
    color: #FFFAEC; 
    border: 2px solid #555555; 
    border-radius: 5px;
    margin-top: 35px;
    transition: all 0.3s ease;
    font-weight: 500;
    letter-spacing: 0.5px;
    /* เปลี่ยน Box Shadow ให้ดูเป็นการฉีก/เปิด */
    box-shadow: 0 3px 0 #111111; 
}

#force-play-button:hover {
    background-color: #555555;
    transform: translateY(1px);
    box-shadow: 0 2px 0 #111111; 
}

/* CSS Animation */
@keyframes bounceIn {
    0% {
        transform: scale(0.3) rotate(-10deg);
        opacity: 0;
    }
    100% {
        transform: scale(1) rotate(-2deg);
        opacity: 1;
    }
}
</style>

<body>
    {{-- <div id="play-prompt"> 
        <p class="mb-4 text-xl">
            🎅 เสียงอัตโนมัติถูกเบราว์เซอร์บล็อก <br>
            กรุณากดปุ่มเพื่อเปิดเสียงและเริ่มการเล่น!
        </p>
        <button id="force-play-button">
            คลิกเพื่อเล่นเสียง "Ho Ho Ho"
        </button>
    </div> --}}
    <div id="play-prompt"> 
        <div id="card-content">
            <!-- 📝 ข้อความบนจดหมาย -->
            <h2 style="color: #e4391b; font-size: 2.2em; margin-bottom: 5px; font-family: Varela Round, serif;">
                {{-- TO: THE WONDERFUL USER --}}
                Merry Christmas
            </h2>
            
            <p style="font-size: 1.2em; color: #555; margin-bottom: 5px;">
                จาก: ซานต้าคลอส 🎅
            </p>
    
            <!-- 🦌 เนื้อหาข้อความ -->
            <p style="font-size: 1.5em; color: #333; margin-top: 25px;">
                **จดหมายแห่งเทศกาล** <br>
                กำลังรอให้คุณเปิดผนึกอยู่!
            </p>
    
            <button id="force-play-button">
                ✨ เปิดจดหมาย ✨
            </button>
        </div>
    </div>
    </div>
    <audio src="audio/hohoho.mp3" id="christmas-sound" preload="auto"></audio>
    <div class="santa-container">

        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="350" height="400">
            <path fill="transparent" d="M0 0h350v400H0z" />
            <g class="plane">
                <rect x="215.747" y="157.738" width="25.511" height="43.645" rx="12.755" ry="12.755"
                    fill="#711723" />
                <path fill="#f40009"
                    d="M166.263 185.401h74.995v31.965h-74.995zM166.263 217.366h74.995a31.965 31.965 0 01-31.965 31.965h-43.03v-31.965z" />
                <g class="hand">
                    <rect x="136.437" y="152.836" width="26.365" height="9.113" rx="4.557" ry="4.557"
                        transform="rotate(-120 149.62 157.393)" fill="#f6bfb1" />
                    <path fill="#f40009" d="M144.906 163.746l11.978-6.916 20.407 35.346-11.978 6.916z" />
                    <rect x="139.226" y="154.214" width="20.172" height="6.973" rx="3.486" ry="3.486"
                        transform="rotate(-30 149.312 157.7)" fill="#e6e6e6" />
                </g>
                <path fill="#f6bfb1" d="M171.488 155.28h37.805v23.974h-37.805z" />
                <path
                    d="M165.956 185.093v64.545h-12.602v-.024c-.406.015-.818.024-1.23.024a32.272 32.272 0 110-64.545c.412 0 .824.01 1.23.025v-.025z"
                    fill="#711723" />
                <path fill="#300403" d="M161.345 185.093h4.918v64.545h-4.918z" />
                <path
                    d="M113.376 210.296v11.987h-2.34v-.004a6.053 6.053 0 01-.23.004 5.993 5.993 0 110-11.987c.077 0 .154.002.23.005v-.005z"
                    fill="#f40009" />
                <g fill="#300403">
                    <circle cx="155.505" cy="244.106" r="2.459" />
                    <circle cx="155.505" cy="190.933" r="2.459" />
                    <circle cx="155.505" cy="208.452" r="2.459" />
                    <circle cx="155.505" cy="226.586" r="2.459" />
                </g>
                <rect class="blade" x="113.244" y="167.266" width="6.762" height="98.354" rx="3.381"
                    ry="3.381" fill="#300403" />
                <path
                    d="M195.154 211.526h34.732a4.918 4.918 0 014.917 4.918 4.918 4.918 0 01-4.917 4.917h-34.732a4.918 4.918 0 01-4.917-4.917 4.918 4.918 0 014.917-4.918z"
                    fill="#711723" />
                <g fill="#fff">
                    <rect x="174.148" y="171.282" width="15.925" height="40.192" rx="7.963" ry="7.963" />
                    <rect x="188.824" y="171.282" width="15.925" height="40.192" rx="7.963" ry="7.963" />
                    <rect x="180.862" y="167.691" width="15.925" height="51.21" rx="7.963" ry="7.963"
                        transform="rotate(-90 188.824 193.296)" />
                    <path
                        d="M161.55 180.896a7.963 7.963 0 016.42-9.252l20.066-3.625a7.963 7.963 0 019.251 6.42 7.963 7.963 0 01-6.42 9.251l-20.066 3.626a7.963 7.963 0 01-9.251-6.42z" />
                    <path
                        d="M183.122 174.543a7.963 7.963 0 019.251-6.42l19.491 3.521a7.963 7.963 0 016.42 9.252 7.963 7.963 0 01-9.251 6.42l-19.491-3.522a7.963 7.963 0 01-6.42-9.25z" />
                </g>
                <rect x="167.185" y="151.899" width="6.455" height="27.355" rx="3.227" ry="3.227"
                    fill="#711723" />
                <rect x="207.449" y="151.899" width="6.455" height="27.355" rx="3.227" ry="3.227"
                    fill="#711723" />
                <circle cx="190.083" cy="165.883" r="3.842" fill="#e76160" />
                <circle cx="190.083" cy="179.868" r="6.454" />
                <path fill="#f40009"
                    d="M167.185 148.21h46.718v7.069h-46.718zM213.903 145.137h-46.718a10.757 10.757 0 0110.757-10.758h25.204a10.757 10.757 0 0110.757 10.758z" />
                <path fill="#711723" d="M167.185 143.907h46.718v4.303h-46.718z" />
                <circle cx="181.016" cy="146.059" r="7.377" fill="#711723" />
                <circle cx="181.016" cy="146.059" r="5.62" fill="#300403" />
                <circle cx="200.072" cy="146.059" r="7.377" fill="#711723" />
                <circle cx="200.072" cy="146.059" r="5.62" fill="#300403" />
                <path d="M176.713 165.422s2.459-3.995 6.454 0M197.306 165.422s2.459-3.995 6.454 0" fill="none"
                    stroke="#000" stroke-miterlimit="10" stroke-width="1.844" />
            </g>
        </svg>
    </div>
    <div class="snowflakes">
        <script>
            for (var i = 0; i < 10; i++) {
                document.write("<div class='snowflake'>❅</div>");
            }
        </script>
    </div>
    <ul class="lightrope">
        <script>
            for (var i = 0; i < window.screen.width / 50; i++) {
                document.write("<li></li>");
            }
        </script>
    </ul>
    <h1>Merry Christmas!</h1>
    <div class="tree-container">
        <div class="tree">
            <div class="star"></div>
            <div class="cone tree-cone1"></div>
            <div class="cone tree-cone2"></div>
            <div class="cone tree-cone3"></div>
            <div class="trunk"></div>
            <div class="ornament or1">
                <div class="shine"></div>
            </div>
            <div class="ornament or2">
                <div class="shine"></div>
            </div>
            <div class="ornament or3">
                <div class="shine"></div>
            </div>
            <div class="ornament or4">
                <div class="shine"></div>
            </div>
            <div class="ornament or5">
                <div class="shine"></div>
            </div>
            <div class="ornament or6">
                <div class="shine"></div>
            </div>
            <div class="bells-container">
                <div class="bell bell1">
                    <div class="bell-top"></div>
                    <div class="bell-bottom"></div>
                    <div class="bell-mid"></div>
                </div>
                <div class="bell bell2">
                    <div class="bell-top"></div>
                    <div class="bell-bottom"></div>
                    <div class="bell-mid"></div>
                </div>
                <div class="bow">
                    <div class="b1"></div>
                    <div class="b2"></div>
                    <div class="b3"></div>
                </div>
            </div>
        </div>
        <div class="gift"></div>
        <div class="ribbon"></div>
        <div class="gift2"></div>
        <div class="ribbon2"></div>
        <div class="shadow"></div>
    </div>
    <div id="flipdown" class="flipdown"></div>
    <div class="deer-container">
        <div class="artboard">
            <div class="deer">
                <div class="rocking">
                    <div class="head">
                        <div class="horns">
                            <div class="horn horn-left">
                                <div class="line line-one"></div>
                                <div class="line line-two"></div>
                                <div class="line line-three"></div>
                            </div>
                            <div class="horn horn-right">
                                <div class="line line-one"></div>
                                <div class="line line-two"></div>
                                <div class="line line-three"></div>
                            </div>
                        </div>
                        <div class="ears">
                            <div class="ear ear-left"></div>
                            <div class="ear ear-right"></div>
                        </div>
                        <div class="eyes">
                            <div class="eye eye-left"></div>
                            <div class="eye eye-right"></div>
                        </div>
                        <div class="nose"></div>
                    </div>
                    <div class="body">
                        <div class="shadow"></div>
                        <div class="hooves">
                            <div class="hoof-one">
                                <div class="line"></div>
                                <div class="anim-part">
                                    <div class="circle">
                                        <div class="circle">
                                            <div class="circle">
                                                <div class="circle">
                                                    <div class="circle circle-last"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hoof-two">
                                <div class="line-one"></div>
                                <div class="line-two"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tail">
                        <div class="circle">
                            <div class="circle">
                                <div class="circle">
                                    <div class="circle">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="legs">
                    <div class="leg-left">
                        <div class="anim-part">
                            <div class="line"></div>
                        </div>
                    </div>
                    <div class="leg-right">
                        <div class="anim-part">
                            <div class="circle">
                                <div class="circle">
                                    <div class="circle">
                                        <div class="circle">
                                            <div class="circle">
                                                <div class="circle">
                                                    <div class="circle">
                                                        <div class="circle">
                                                            <div class="circle circle-last"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="presents">
                <div class="present present-one"></div>
                <div class="present present-two"></div>
                <div class="present present-two present-two-right"></div>
                <div class="present present-three"></div>
            </div>
        </div>
    </div>
</body>
<script>
    // ... โค้ด nextXmasDate function ...
    
    document.addEventListener("DOMContentLoaded", () => {
        // ... โค้ด FlipDown.start() ...

        // --- 2. การจัดการเสียง Ho Ho Ho และ Autoplay Prompt ---
        const playPrompt = document.getElementById('play-prompt');
        const forcePlayButton = document.getElementById('force-play-button');
        const christmasSound = document.getElementById('christmas-sound'); 
        
        // 🚨 พยายามเล่นเสียงอัตโนมัติก่อน (ถ้าถูกบล็อก หน้าจอจะยังแสดงอยู่)
        christmasSound.play()
            .then(() => {
                // ถ้าเล่นได้ทันที: ซ่อน prompt
                playPrompt.style.display = 'none';
            })
            .catch(error => {
                // ถ้าถูกบล็อก: ปล่อยให้ prompt แสดง (display: flex ถูกกำหนดใน CSS แล้ว)
                console.warn("Autoplay was prevented. Showing prompt to user.");
            });

        // 🖱️ Event Listener สำหรับปุ่มคลิก
        forcePlayButton.addEventListener('click', () => {
            christmasSound.play()
                .then(() => {
                    // เล่นสำเร็จ: ซ่อนหน้าจอ prompt
                    playPrompt.style.display = 'none';
                })
                .catch(error => {
                    // เล่นไม่สำเร็จ: ซ่อนหน้าจอ prompt เพื่อให้ผู้ใช้เข้าสู่หน้าหลัก
                    playPrompt.style.display = 'none';
                });
        });
    });
</script>
{{-- 

const nextXmasDate = (currentTime) => {
    let xmasDate = new Date(currentTime.getFullYear() + "-12-25T00:00:00");
    if (currentTime.getTime() > xmasDate.getTime()) {
      let nextYear = currentTime.getFullYear() + 1;
      xmasDate = new Date(nextYear + "-12-25T00:00:00");
    }
    return xmasDate;
  };
  
  document.addEventListener("DOMContentLoaded", () => {
    // Unix timestamp (in seconds) to count down to
    let nextXmas = nextXmasDate(new Date()).getTime() / 1000;
  
    // Set up FlipDown
    let flipdown = new FlipDown(nextXmas)
  
      // Start the countdown
      .start()
  
      // Do something when the countdown ends
      .ifEnded(() => {
        console.log("The countdown has ended!");
      });
  }); --}}
</html>
