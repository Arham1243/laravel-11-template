@if (!empty($config['COMPANYPHONE']))
    <li>
        <a href="tel:{{ $config['COMPANYPHONE'] }}">
            <i class="bx bxs-phone"></i>
            {{ $config['COMPANYPHONE'] }}</a>
    </li>
@endif
@if (!empty($config['COMPANYEMAIL']))
    <li>
        <a href="mailto:{{ $config['COMPANYEMAIL'] }}">
            <i class="bx bxs-envelope"></i>
            {{ $config['COMPANYEMAIL'] }}</a>
    </li>
@endif
@if (!empty($config['FACEBOOK']))
    <li>
        <a href="{{ sanitizedLink($config['FACEBOOK']) }}" target="_blank"><i class="bx bxl-facebook"></i></a>
    </li>
@endif
@if (!empty($config['INSTAGRAM']))
    <li>
        <a href="{{ sanitizedLink($config['INSTAGRAM']) }}" target="_blank"><i class="bx bxl-instagram"></i></a>
    </li>
@endif
@if (!empty($config['TWITTER']))
    <li>
        <a href="{{ sanitizedLink($config['TWITTER']) }}" target="_blank"><i class="bx bxl-twitter"></i></a>
    </li>
@endif
</ul>