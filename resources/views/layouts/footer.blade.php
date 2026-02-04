<footer class="relative bg-gray-800">
    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between text-sm font-medium text-white">
      <span class="text-sm text-body sm:text-center">© 2026 <a href="#" class="hover:underline">Vozila</a>. All Rights Reserved.
              Okolina: {{ app()->environment() }} |
        <span style="text-align: right;">DB: {{ config('database.connections.mysql.database') }}</span>
    </span>
    </div>
</footer>

</body>
</html>