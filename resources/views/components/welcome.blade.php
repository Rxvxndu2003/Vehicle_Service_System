<div class="relative bg-cover bg-center h-screen" >
    <div class="absolute inset-0 bg-gray-200 bg-opacity-25"></div>

    <div class="p-6 lg:p-8 relative z-10">

        <h1 class="mt-8 text-4xl font-bold text-center text-black">
            Welcome to M & N Service!
        </h1>

        <p class="mt-6 text-center font-bold text-gray-200 leading-relaxed max-w-3xl mx-auto text-black">
            M & N Service is a dedicated provider of comprehensive solutions,With a commitment to quality and customer satisfaction, M & N Service strives to deliver reliable, efficient, and personalized services tailored to meet the unique needs of every client. Whether it's routine maintenance or complex repairs, M & N Service combines expertise and attention to detail, ensuring that your needs are met with the highest standard of care.
        </p>

        <!-- Centered Buttons for Redirection -->
        <div class="mt-10 flex justify-center space-x-8">
            <a href="{{ route('appointments.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-indigo-700">
                Appointment
            </a>
            <a href="{{ route('orders.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-indigo-700">
                Order
            </a>
        </div>
    </div>

    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8 relative z-10" style="background-image: url('{{ asset('img/about.jpg') }}');" >
        <div>
            <div class="flex items-center">
                
            </div>
            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                
            </p>
            <p class="mt-4 text-sm">
               
            </p>
        </div>

        <!-- Add more sections as needed -->
    </div>
</div>
