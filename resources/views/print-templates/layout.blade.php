<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
  </head>
  <body>

      @component('print-templates._partials.styles')
      @endcomponent


      <div class="invoice-box">
          <h1 style="text-align: center;">@yield('name')</h1>
          <table cellpadding="0" cellspacing="0">
              <tr class="top">
                  <td colspan="4">
                      {{-- <table> --}}
                          <tr>
                              <td class="title" colspan="2">
                                  @yield('top-left')
                              </td>

                              <td colspan="2">
                                  @yield('top-right')
                              </td>
                          </tr>
                      {{-- </table> --}}
                  </td>
              </tr>

              @yield('top-spacer')

              <tr class="information">
                  <td colspan="2">
                      @yield('shipping')
                  </td>

                  <td colspan="2">
                      @yield('billing')
                  </td>
              </tr>

              <tr class="details">
                  @yield('details-row')
              </tr>
              <tr class="details">
                  @yield('details-row-2')
              </tr>
              <tr class="details">
                  @yield('details-row-3')
              </tr>
          </table>

          @yield('products-spacer')

          <table cellpadding="0" cellspacing="0">
              <tr class="heading">
                  @yield('product-headings')
              </tr>

              @yield('products')

              @yield('totals')
          </table>

          @component('print-templates._partials.branding')
          @endcomponent

          @component('print-templates._partials.terms')
          @endcomponent

          @component('print-templates._partials.legal')
          @endcomponent

          @yield('bottom')
      </div>
      @if (isset($page_break) && $page_break)
          <div class="page_break"></div>
      @endif

  </body>
</html>
