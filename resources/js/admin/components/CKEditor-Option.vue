<template>
  <textarea :id="editorId"></textarea>
</template>

<script>
export default {
  name: "ContentEditor",
  props: {
    modelValue: { type: String, default: "" },
    height: { type: Number, default: 500 },
    editorId: {
      type: String,
      default() {
        return "ckeditor-" + Math.random().toString(36).substring(2, 9);
      }
    }
  },

  emits: ["update:modelValue"],

  data() {
    return {
      editorInstance: null,
    };
  },

  mounted() {
    this.loadAdminCss();
    this.initEditor();
  },

  beforeUnmount() {
    if (this.editorInstance) {
      this.editorInstance.destroy(true);
    }
  },

  methods: {
    loadAdminCss() {
      this.adminCssLinks = [...document.querySelectorAll('link[rel="stylesheet"]')]
          .map(link => link.href)
          .filter(href => href.includes('fonts.googleapis.com') || href.includes('fonts.gstatic.com'));
    },
    extractGoogleFontNames(url) {
      const result = [];
      const families = url.match(/family=[^&]+/g);
      if (!families) return result;
      families.forEach(f => {
        const name = f
            .replace('family=', '')
            .split(':')[0]
            .replace(/\+/g, ' ')
            .trim();
        if (name) result.push(name);
      });
      return result;
    },
    getGoogleFontsList() {
      const fonts = [];

      this.adminCssLinks.forEach(url => {
        fonts.push(...this.extractGoogleFontNames(url));
      });

      return [...new Set(fonts)];
    },
    initEditor() {

      const css1 = document.querySelector('meta[name="public-css-1"]')?.content || '';
      const css2 = document.querySelector('meta[name="public-css-2"]')?.content || '';
      const fonts = this.getGoogleFontsList();
      const fontList = fonts.map(f => `${f}/${f}`).join(';');

      if (!window.CKEDITOR) {
        console.error("CKEditor not loaded!");
        return;
      }

      this.editorInstance = CKEDITOR.replace(this.editorId, {
        height: this.height,
        language: 'en',
        contentsCss: [css1, css2, ...this.adminCssLinks],
        font_names: fontList,
        allowedContent: true,
        removeDialogTabs: 'image:advanced;link:advanced',
        format_tags: 'h1;h2;h3;h4;p',
        filebrowserUploadUrl: '/admin/media/upload?_token=' + document.querySelector('meta[name="csrf-token"]').content,
        filebrowserImageUploadUrl: '/admin/media/upload?_token=' + document.querySelector('meta[name="csrf-token"]').content,
        uploadUrl: '/admin/media/upload?_token=' + document.querySelector('meta[name="csrf-token"]').content,
        filebrowserUploadMethod: 'form',
        toolbarGroups: [
          { name: 'clipboard', groups: ['clipboard', 'undo'] },
          { name: 'editing', groups: ['find', 'selection', 'spellchecker'] },
          { name: 'links' },
          { name: 'insert' },
          { name: 'forms' },
          { name: 'tools' },
          { name: 'document', groups: ['mode', 'document', 'doctools'] },
          { name: 'others' },
          '/',
          { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
          { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'] },
          { name: 'styles' },
          { name: 'colors' },
          { name: 'about' }
        ],
      });

      this.editorInstance.on("change", () => {
        this.$emit("update:modelValue", this.editorInstance.getData());
      });

      this.editorInstance.setData(this.modelValue);
    },
  },

  watch: {
    modelValue(newVal) {
      if (
          this.editorInstance &&
          newVal !== this.editorInstance.getData()
      ) {
        this.editorInstance.setData(newVal);
      }
    },
  },
};
</script>
