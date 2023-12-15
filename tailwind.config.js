import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    darkMode: 'class',
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}


// import colors from 'tailwindcss/colors' 
// import forms from '@tailwindcss/forms'
// import typography from '@tailwindcss/typography' 
 
// export default {
//     content: [
//         './resources/**/*.blade.php',
//         './vendor/filament/**/*.blade.php', 
//     ],
//     darkMode: 'class',
//     theme: {
//         extend: {
//             colors: { 
//                 danger: colors.rose,
//                 primary: colors.blue,
//                 success: colors.green,
//                 warning: colors.yellow,
//             }, 
//         },
//     },
//     plugins: [
//         forms, 
//         typography, 
//     ],
// }