Ext.onReady(function () {
  const pageSize = 12;
  let currentDate = Ext.Date.format(new Date(), 'Y-m-d');
  let currentPage = 1;
  let totalRecords = 0;
  let allLoaded = false;
  let loading = false;

  const rateStore = Ext.create('Ext.data.Store', {
    fields: ['base', 'target', 'rate'],
    proxy: {
      type: 'ajax',
      url: '/api/rates',
      reader: {
        type: 'json',
        rootProperty: 'data',
        totalProperty: 'total',
        successProperty: 'success'
      }
    },
    autoLoad: false
  });

  const dataview = Ext.create('Ext.view.View', {
    store: rateStore,
    tpl: new Ext.XTemplate(
      '<div class="container-fluid">',
        '<div class="row">',
          '<tpl for=".">',
            '<div class="col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">',
              '<div class="rate-box">{base} → {target}:<br><span>{rate}</span></div>',
            '</div>',
          '</tpl>',
        '</div>',
      '</div>'
    ),
    itemSelector: 'div.rate-box',
    emptyText: '<div class="empty-text">No rates found.</div>',
    scrollable: true,
    flex: 1,
    listeners: {
      afterrender: function (view) {
        const el = view.getScrollable().getElement().dom;

        attemptFillScreen(el);

        el.addEventListener('scroll', function () {
          const scrollPos = el.scrollTop + el.clientHeight;
          if (!loading && !allLoaded && scrollPos + 50 >= el.scrollHeight) {
            currentPage++;
            loadRates();
          }
        });
      }
    }
  });

  function attemptFillScreen(el) {
    const attemptFill = setInterval(() => {
      if (!loading && !allLoaded && el.scrollHeight <= el.clientHeight + 30) {
        currentPage++;
        loadRates();
      } else {
        clearInterval(attemptFill);
      }
    }, 100);
  }

  function loadRates(reset = false) {
    loading = true;

    Ext.Ajax.request({
      url: '/api/rates',
      method: 'GET',
      params: {
        date: currentDate,
        page: currentPage,
        limit: pageSize
      },
      success: function (response) {
        const json = Ext.decode(response.responseText);
        if (reset) {
          rateStore.loadData(json.data);
        } else {
          const existing = rateStore.getData().items;
          rateStore.loadData([...existing, ...json.data]);
        }
        console.log(json.data);

        totalRecords = json.total;
        if (rateStore.getCount() >= totalRecords) {
          allLoaded = true;
        }

        loading = false;
      },
      failure: function () {
        loading = false;
        Ext.Msg.alert('Error', 'Failed to load rates.');
      }
    });
  }

  Ext.create('Ext.container.Viewport', {
    layout: {
      type: 'vbox',
      align: 'center'
    },
    padding: 20,
    items: [
      {
        xtype: 'component',
        html: '<div class="header">Yet Another Forex</div>',
        width: '100%',
        style: 'margin-bottom: 15px;'
      },
      {
        xtype: 'container',
        layout: {
            type: 'hbox',
            align: 'middle'
        },
        width: '100%',
        padding: '0 10 10 10',
        items: [
            {
                xtype: 'component',
                itemId: 'ratesLabel',
                html: `<strong>Rates as of ${Ext.Date.format(new Date(), 'd-m-Y')}</strong>`,
                flex: 1,
                style: 'font-size:16px;'
            },
            {
                xtype: 'datefield',
                value: new Date(),
                format: 'd-m-Y',
                listeners: {
                    change: function (field, newDate) {
                        currentDate = Ext.Date.format(newDate, 'Y-m-d');
                        currentPage = 1;
                        allLoaded = false;

                        field.up('container').down('#ratesLabel')
                            .update(`<strong>Rates as of ${Ext.Date.format(newDate, 'd-m-Y')}</strong>`);

                        loadRates(true);

                        Ext.defer(() => {
                            const el = dataview.getScrollable().getElement().dom;
                            attemptFillScreen(el);
                        }, 100);
                    }
                }
            }
        ]
      },
      {
        xtype: 'container',
        layout: 'fit',
        width: '100%',
        height: '100%',
        flex: 1,
        style: 'overflow-y: auto;',
        items: [dataview]
      }
    ]
  });

  loadRates(true);
});
